<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use Dbp\Relay\BasePersonBundle\API\PersonProviderInterface;
use Dbp\Relay\BasePersonBundle\Entity\Person;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Entity\RequestPersistence;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\HttpFoundation\Response;
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

    public function __construct(
        PersonProviderInterface $personProvider,
        ManagerRegistry $managerRegistry
    ) {
        $this->personProvider = $personProvider;
        $manager = $managerRegistry->getManager('dbp_relay_dispatch_bundle');
        assert($manager instanceof EntityManagerInterface);
        $this->em = $manager;
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
        /** @var RequestPersistence $requestPersistence */
        $requestPersistence = $this->em
            ->getRepository(RequestPersistence::class)
            ->find($identifier);

        if (!$requestPersistence) {
            throw ApiError::withDetails(Response::HTTP_NOT_FOUND, 'Request was not found!', 'dispatch:request-not-found');
        }

        return Request::fromRequestPersistence($requestPersistence);
    }

    /**
     * Fetches all Request entities for the current person.
     *
     * @return Request[]
     */
    public function getRequestsForCurrentPerson(): array
    {
        $person = $this->getCurrentPerson();

        $requestPersistences = $this->em
            ->getRepository(RequestPersistence::class)
            ->findBy(['personIdentifier' => $person->getIdentifier()]);

        return Request::fromRequestPersistences($requestPersistences);
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
            ->getRepository(RequestPersistence::class)
            ->matching($criteria);

        return Request::fromRequestPersistences($result->getValues());
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
        // Prevent "Detached entity cannot be removed" error by fetching the RequestPersistence
        // instead of using "RequestPersistence::fromRequest($request)".
        // "$this->em->merge" would fix it too, but is deprecated
        /** @var RequestPersistence $requestPersistence */
        $requestPersistence = $this->em
            ->getRepository(RequestPersistence::class)
            ->find($request->getIdentifier());

        $this->em->remove($requestPersistence);
        $this->em->flush();
    }

    public function createRequestForCurrentPerson(Request $request): Request
    {
        $personId = $this->personProvider->getCurrentPerson()->getIdentifier();

        $requestPersistence = new RequestPersistence();
        $requestPersistence->setIdentifier((string) Uuid::v4());
        $requestPersistence->setPersonIdentifier($personId);
        $requestPersistence->setDateCreated(new \DateTime('now'));
        $requestPersistence->setSenderGivenName($request->getSenderGivenName() ?? '');
        $requestPersistence->setSenderFamilyName($request->getSenderFamilyName() ?? '');
        $requestPersistence->setSenderPostalAddress($request->getSenderPostalAddress() ?? '');

        try {
            $this->em->persist($requestPersistence);
            $this->em->flush();
        } catch (\Exception $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'Request could not be created!', 'dispatch:request-not-created', ['message' => $e->getMessage()]);
        }

        return Request::fromRequestPersistence($requestPersistence);
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
}
