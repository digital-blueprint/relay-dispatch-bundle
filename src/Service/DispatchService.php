<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use Dbp\Relay\BasePersonBundle\API\PersonProviderInterface;
use Dbp\Relay\BasePersonBundle\Entity\Person;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Entity\RequestStatusChange;
use Dbp\Relay\DispatchBundle\Message\RequestSubmissionMessage;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Uid\Uuid;

class DispatchService
{
    /**
     * @var PersonProviderInterface
     */
    private $personProvider;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var ?CacheItemPoolInterface
     */
    private $cachePool;

    /**
     * @var MessageBusInterface
     */
    private $bus;

    public function __construct(
        PersonProviderInterface $personProvider,
        ManagerRegistry $managerRegistry,
        MessageBusInterface $bus
    ) {
        $this->personProvider = $personProvider;
        $manager = $managerRegistry->getManager('dbp_relay_dispatch_bundle');
        assert($manager instanceof EntityManagerInterface);
        $this->em = $manager;
        $this->bus = $bus;
    }

    public function setCache(?CacheItemPoolInterface $cachePool)
    {
        $this->cachePool = $cachePool;
    }

    private function getCurrentPerson(): Person
    {
        $person = $this->personProvider->getCurrentPerson();

        if (!$person) {
            throw ApiError::withDetails(Response::HTTP_FORBIDDEN, "Current person wasn't found!", 'dispatch:current-person-not-found');
        }

        return $person;
    }

    public function checkConnection()
    {
        $this->em->getConnection()->connect();
    }

    /**
     * Fetches a Request.
     */
    public function getRequestById(string $identifier): ?Request
    {
        /** @var Request $request */
        $request = $this->em
            ->getRepository(Request::class)
            ->find($identifier);

        if (!$request) {
            throw ApiError::withDetails(Response::HTTP_NOT_FOUND, 'Request was not found!', 'dispatch:request-not-found');
        }

        return $request;
    }

    /**
     * Fetches a RequestStatusChange.
     */
    public function getRequestStatusChangeById(string $identifier): ?RequestStatusChange
    {
        /** @var RequestStatusChange $requestStatusChange */
        $requestStatusChange = $this->em
            ->getRepository(RequestStatusChange::class)
            ->find($identifier);

        if (!$requestStatusChange) {
            throw ApiError::withDetails(Response::HTTP_NOT_FOUND, 'RequestStatusChange was not found!', 'dispatch:request-status-change-not-found');
        }

        return $requestStatusChange;
    }

    /**
     * Fetches a RequestRecipient.
     */
    public function getRequestRecipientById(string $identifier): ?RequestRecipient
    {
        /** @var RequestRecipient $requestRecipient */
        $requestRecipient = $this->em
            ->getRepository(RequestRecipient::class)
            ->find($identifier);

        if (!$requestRecipient) {
            throw ApiError::withDetails(Response::HTTP_NOT_FOUND, 'RequestRecipient was not found!', 'dispatch:request-recipient-not-found');
        }

        return $requestRecipient;
    }

    /**
     * Fetches a RequestFile.
     */
    public function getRequestFileById(string $identifier): ?RequestFile
    {
        /** @var RequestFile $requestFile */
        $requestFile = $this->em
            ->getRepository(RequestFile::class)
            ->find($identifier);

        if (!$requestFile) {
            throw ApiError::withDetails(Response::HTTP_NOT_FOUND, 'RequestFile was not found!', 'dispatch:request-file-not-found');
        }

        return $requestFile;
    }

    /**
     * Fetches all Request entities for the current person.
     *
     * @return Request[]
     */
    public function getRequestsForCurrentPerson(): array
    {
        $person = $this->getCurrentPerson();

        $requests = $this->em
            ->getRepository(Request::class)
            ->findBy(['personIdentifier' => $person->getIdentifier()]);

        return $requests;
    }

    /**
     * Fetches all expired Request entities.
     *
     * @return Request[]
     */
    public function getExpiredRequests(): array
    {
        $expr = Criteria::expr();
        $criteria = Criteria::create();
        $criteria->where($expr->lt('validUntil', new \DateTime('now')));

        $result = $this->em
            ->getRepository(Request::class)
            ->matching($criteria);

        return $result->getValues();
    }

    /**
     * Fetches a Request for the current person.
     */
    public function getRequestByIdForCurrentPerson(string $identifier): ?Request
    {
        $request = $this->getRequestById($identifier);
        $person = $this->getCurrentPerson();

        if ($person->getIdentifier() !== $request->getPersonIdentifier()) {
            throw ApiError::withDetails(Response::HTTP_FORBIDDEN, "Current person doesn't own this request!", 'dispatch:person-does-not-own-request');
        }

        return $request;
    }

    /**
     * Fetches a RequestStatusChange for the current person.
     */
    public function getRequestStatusChangeByIdForCurrentPerson(string $identifier): ?RequestStatusChange
    {
        $requestStatusChange = $this->getRequestStatusChangeById($identifier);

        // Check if current person owns the request
        $this->getRequestByIdForCurrentPerson($requestStatusChange->getDispatchRequestIdentifier());

        return $requestStatusChange;
    }

    /**
     * Fetches a RequestRecipient for the current person.
     */
    public function getRequestRecipientByIdForCurrentPerson(string $identifier): ?RequestRecipient
    {
        $requestRecipient = $this->getRequestRecipientById($identifier);

        // Check if current person owns the request
        $this->getRequestByIdForCurrentPerson($requestRecipient->getDispatchRequestIdentifier());

        return $requestRecipient;
    }

    /**
     * Fetches a RequestFile for the current person.
     */
    public function getRequestFileByIdForCurrentPerson(string $identifier): ?RequestFile
    {
        $requestFile = $this->getRequestFileById($identifier);

        // Check if current person owns the request
        $this->getRequestByIdForCurrentPerson($requestFile->getDispatchRequestIdentifier());

        return $requestFile;
    }

    /**
     * Removes a Request for the current person.
     */
    public function removeRequestByIdForCurrentPerson(string $identifier): void
    {
        $request = $this->getRequestByIdForCurrentPerson($identifier);

        if ($request) {
            $this->removeRequest($request);
        }
    }

    /**
     * Removes a Request.
     */
    public function removeRequest(Request $request): void
    {
        // Prevent "Detached entity cannot be removed" error by fetching the Request
        // instead of using "Request::fromRequest($request)".
        // "$this->em->merge" would fix it too, but is deprecated
        /** @var Request $request */
        $request = $this->em
            ->getRepository(Request::class)
            ->find($request->getIdentifier());

        $this->em->remove($request);
        $this->em->flush();
    }

    public function updateRequestForCurrentPerson(Request $request): Request
    {
        $person = $this->getCurrentPerson();

        if ($person->getIdentifier() !== $request->getPersonIdentifier()) {
            throw ApiError::withDetails(Response::HTTP_FORBIDDEN, "Current person doesn't own this request!", 'dispatch:person-does-not-own-request');
        }

        try {
            $this->em->persist($request);
            $this->em->flush();
        } catch (\Exception $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'Request could not be updated!', 'dispatch:request-not-created', ['message' => $e->getMessage()]);
        }

        return $request;
    }

    public function createRequestForCurrentPerson(Request $request): Request
    {
        $personId = $this->getCurrentPerson()->getIdentifier();

        $request->setIdentifier((string) Uuid::v4());
        $request->setPersonIdentifier($personId);
        $request->setDateCreated(new \DateTime('now'));

        try {
            $this->em->persist($request);
            $this->em->flush();
        } catch (\Exception $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'Request could not be created!', 'dispatch:request-not-created', ['message' => $e->getMessage()]);
        }

        return $request;
    }

    /**
     * Removes all requests of the current person.
     *
     * Because of the unique key only a maximum of one request should be removed,
     * so there is no real need to do that in one query.
     */
    public function removeAllRequestsForCurrentPerson()
    {
        $reviews = $this->getRequestsForCurrentPerson();

        foreach ($reviews as $request) {
            $this->removeRequest($request);
        }
    }

    public function createRequestRecipient(RequestRecipient $requestRecipient): RequestRecipient
    {
        // A request object needs to be set for the ORM, setting the identifier only will not persist it
        $request = $this->getRequestById($requestRecipient->getDispatchRequestIdentifier());

        $requestRecipient->setIdentifier((string) Uuid::v4());
        $requestRecipient->setRequest($request);
        $requestRecipient->setRecipientId('');
        $requestRecipient->setDateCreated(new \DateTime('now'));

        try {
            $this->em->persist($requestRecipient);
            $this->em->flush();
        } catch (\Exception $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestRecipient could not be created!', 'dispatch:request-recipient-not-created', ['message' => $e->getMessage()]);
        }

        return $requestRecipient;
    }

    public function updateRequestRecipient(RequestRecipient $requestRecipient): RequestRecipient
    {
        try {
            $this->em->persist($requestRecipient);
            $this->em->flush();
        } catch (\Exception $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestRecipient could not be updated!', 'dispatch:request-recipient-not-created', ['message' => $e->getMessage()]);
        }

        return $requestRecipient;
    }

    public function removeRequestRecipientById(string $identifier)
    {
        /** @var RequestRecipient $requestRecipient */
        $requestRecipient = $this->em
            ->getRepository(RequestRecipient::class)
            ->find($identifier);

        $this->em->remove($requestRecipient);
        $this->em->flush();
    }

    public function createRequestFile(UploadedFile $uploadedFile, string $dispatchRequestIdentifier): RequestFile
    {
        $data = $uploadedFile->getContent();
        $requestFile = new RequestFile();

        // A request object needs to be set for the ORM, setting the identifier only will not persist it
        $requestFile->setDispatchRequestIdentifier($dispatchRequestIdentifier);
        $request = $this->getRequestById($requestFile->getDispatchRequestIdentifier());
        $requestFile->setRequest($request);

        $requestFile->setIdentifier((string) Uuid::v4());
        $requestFile->setDateCreated(new \DateTime('now'));
        $requestFile->setName($uploadedFile->getClientOriginalName());
        $requestFile->setData($data);
        $requestFile->setFileFormat($uploadedFile->getClientMimeType());
        $requestFile->setContentSize($uploadedFile->getSize());

        try {
            $this->em->persist($requestFile);
            $this->em->flush();
        } catch (\Exception $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be created!', 'dispatch:request-file-not-created', ['message' => $e->getMessage()]);
        }

        return $requestFile;
    }

    public function createRequestStatusChange(string $dispatchRequestIdentifier, int $statusType, string $description): RequestStatusChange
    {
        $requestStatusChange = new RequestStatusChange();

        // A request object needs to be set for the ORM, setting the identifier only will not persist it
        $requestStatusChange->setDispatchRequestIdentifier($dispatchRequestIdentifier);
        $request = $this->getRequestById($requestStatusChange->getDispatchRequestIdentifier());
        $requestStatusChange->setRequest($request);

        $requestStatusChange->setIdentifier((string) Uuid::v4());
        $requestStatusChange->setDateCreated(new \DateTime('now'));
        $requestStatusChange->setStatusType($statusType);
        $requestStatusChange->setDescription($description);

        try {
            $this->em->persist($requestStatusChange);
            $this->em->flush();
        } catch (\Exception $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestStatusChange could not be created!', 'dispatch:request-status-not-created', ['message' => $e->getMessage()]);
        }

        return $requestStatusChange;
    }

    public function removeRequestFileById(string $identifier)
    {
        /** @var RequestFile $requestFile */
        $requestFile = $this->em
            ->getRepository(RequestFile::class)
            ->find($identifier);

        $this->em->remove($requestFile);
        $this->em->flush();
    }

    public function submitRequest(Request $request)
    {
        $request->setDateSubmitted(new \DateTime('now'));
        $this->updateRequestForCurrentPerson($request);

        $this->createRequestStatusChange($request->getIdentifier(), RequestStatusChange::STATUS_SUBMITTED, 'Request submitted');

        // Put request in queue for submission
        $this->createAndDispatchRequestSubmissionMessage($request);
    }

    public function createAndDispatchRequestSubmissionMessage(Request $request): RequestSubmissionMessage
    {
        $message = new RequestSubmissionMessage($request);
        $this->bus->dispatch($message);

        return $message;
    }

    public function handleRequestSubmissionMessage(RequestSubmissionMessage $message)
    {
    }
}
