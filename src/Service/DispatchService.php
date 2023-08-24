<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use DateTimeZone;
use Dbp\Relay\BasePersonBundle\API\PersonProviderInterface;
use Dbp\Relay\BasePersonBundle\Entity\Person;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Helpers\Tools;
use Dbp\Relay\CoreBundle\Rest\Options;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\BinaryDocumentType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\Checksum;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\DualDeliveryRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ErrorType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\MetaData as DualDeliveryMetadata;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\PayloadAttributesType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\PayloadType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ProcessingProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\RecipientType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\SenderData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\SenderType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification\DualNotificationRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification\StatusRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\CorporateBodyType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\DeliveryAddress;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\FamilyName;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PersonDataType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PersonNameType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PhysicalPersonType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PostalAddressType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\DualDeliveryPreAddressingRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\DualDeliveryPreAddressingResponseType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\MetaData as PreMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\Recipient;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\Recipients;
use Dbp\Relay\DispatchBundle\DualDeliveryProvider\Vendo\DeliveryQuality;
use Dbp\Relay\DispatchBundle\DualDeliveryProvider\Vendo\ProcessingProfile as VendoProcessingProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryProvider\Vendo\Vendo;
use Dbp\Relay\DispatchBundle\Entity\DeliveryStatusChange;
use Dbp\Relay\DispatchBundle\Entity\PreAddressingRequest;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Message\RequestSubmissionMessage;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LogLevel;
use Psr\Log\NullLogger;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\UnrecoverableMessageHandlingException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Uid\Uuid;

class DispatchService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var PersonProviderInterface
     */
    private $personProvider;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var MessageBusInterface
     */
    private $bus;

    /**
     * @var string
     */
    private $certPassword;

    /**
     * @var string
     */
    private $cert;

    /**
     * @var string
     */
    private $url;

    /**
     * @var DualDeliveryService
     */
    private $dd;

    /**
     * @var mixed
     */
    private $fileStorage;

    /**
     * @var BlobService
     */
    private $blobService;

    public const FILE_STORAGE_DATABASE = 'database';
    public const FILE_STORAGE_BLOB = 'blob';

    public function __construct(
        PersonProviderInterface $personProvider,
        EntityManagerInterface $em,
        MessageBusInterface $bus,
        DualDeliveryService $dd,
        BlobService $blobService
    ) {
        $this->personProvider = $personProvider;
        $this->em = $em;
        $this->bus = $bus;
        $this->dd = $dd;
        $this->logger = new NullLogger();
        $this->blobService = $blobService;
    }

    public function setConfig(array $config)
    {
        $this->certPassword = $config['cert_password'] ?? '';
        $this->cert = $config['cert'] ?? '';
        $this->url = $config['service_url'];
        $this->fileStorage = $config['file_storage'];
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
    public function getRequestById(string $identifier): Request
    {
        /** @var Request $request */
        $request = $this->em
            ->getRepository(Request::class)
            ->find($identifier);

        if (!$request) {
            throw ApiError::withDetails(Response::HTTP_NOT_FOUND, 'Request was not found!', 'dispatch:request-not-found');
        }

        foreach ($request->getRecipients() as $recipient) {
            // Set the last status change manually, doctrine doesn't seem to be able to do this automatically without troubles
            $recipient->setLastStatusChange($this->getLastStatusChange($recipient));
        }

        return $request;
    }

    /**
     * Fetches a DeliveryStatusChange.
     */
    public function getDeliveryStatusChangeById(string $identifier): ?DeliveryStatusChange
    {
        /** @var DeliveryStatusChange $deliveryStatusChange */
        $deliveryStatusChange = $this->em
            ->getRepository(DeliveryStatusChange::class)
            ->find($identifier);

        if (!$deliveryStatusChange) {
            throw ApiError::withDetails(Response::HTTP_NOT_FOUND, 'DeliveryStatusChange was not found!', 'dispatch:request-status-change-not-found');
        }

        return $deliveryStatusChange;
    }

    /**
     * Fetches a RequestRecipient.
     */
    public function getRequestRecipientById(string $identifier): RequestRecipient
    {
        /** @var RequestRecipient $requestRecipient */
        $requestRecipient = $this->em
            ->getRepository(RequestRecipient::class)
            ->find($identifier);

        if (!$requestRecipient) {
            throw ApiError::withDetails(Response::HTTP_NOT_FOUND, 'RequestRecipient was not found!', 'dispatch:request-recipient-not-found');
        }

        // Set the last status change manually, doctrine doesn't seem to be able to do this automatically without troubles
        $requestRecipient->setLastStatusChange($this->getLastStatusChange($requestRecipient));

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

        if ($requestFile->getFileStorageSystem() === self::FILE_STORAGE_BLOB) {
            $blobIdentifier = $requestFile->getFileStorageIdentifier();

            if (strlen($blobIdentifier) > 50) {
                throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile has invalid blob identifier!', 'dispatch:request-file-blob-identifier-invalid');
            }

            $requestFile->setContentUrl($this->blobService->downloadRequestFileAsContentUrl($requestFile));
        }

        return $requestFile;
    }

    /**
     * Fetches the RequestFiles of a Request.
     *
     * @return RequestFile[]
     */
    public function getRequestFilesByRequestId(string $identifier): array
    {
        /** @var RequestFile[] $requestFiles */
        $requestFiles = $this->em
            ->getRepository(RequestFile::class)
            ->findBy(['request' => $identifier]);

        if (!$requestFiles) {
            throw ApiError::withDetails(Response::HTTP_NOT_FOUND, 'RequestFiles were not found!', 'dispatch:request-files-not-found');
        }

        return $requestFiles;
    }

    /**
     * Fetches RequestRecipients where still dual delivery status requests need to be made.
     *
     * @return RequestRecipient[]
     */
    public function getNotFinishedRequestRecipients(): array
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $query = $queryBuilder->select('rr')
            ->from(RequestRecipient::class, 'rr')
            ->leftJoin('rr.request', 'r')
            ->where('r.dateSubmitted IS NOT NULL', 'rr.deliveryEndDate IS NULL');

        return $query->getQuery()->getResult();
    }

    /**
     * Fetches all Request entities for the given group.
     *
     * @return Request[]
     */
    public function getRequestsForGroupId(string $groupId): array
    {
        $requests = $this->em
            ->getRepository(Request::class)
            ->findBy(['groupId' => $groupId]);

        // We need to load the last status changes for every request of each recipient
        // https://plan.tugraz.at/task/39365
        foreach ($requests as $request) {
            foreach ($request->getRecipients() as $recipient) {
                // Set the last status change manually, doctrine doesn't seem to be able to do this automatically without troubles
                $recipient->setLastStatusChange($this->getLastStatusChange($recipient));
            }
        }

        return $requests;
    }

    /**
     * @return RequestRecipient[]
     */
    public function getRequestRecipients(bool $submittedOnly = false, int $limit = 100): array
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $query = $queryBuilder->select('rr')
            ->from(RequestRecipient::class, 'rr')
            ->leftJoin('rr.request', 'r');

        if ($submittedOnly) {
            $query->where('r.dateSubmitted IS NOT NULL');
        }

        $query = $query->orderBy('rr.dateCreated', 'DESC')
            ->setMaxResults($limit)
            ->getQuery();

        return $query->execute();
    }

    /**
     * Removes a Request for the current person.
     */
    public function removeRequestById(string $identifier): void
    {
        $request = $this->getRequestById($identifier);

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

        if ($this->fileStorage === self::FILE_STORAGE_BLOB) {
            $this->blobService->deleteBlobFilesByRequest($request);
        }

        $this->em->remove($request);
        $this->em->flush();
    }

    public function updateRequest(Request $request): Request
    {
        try {
            $this->em->persist($request);
            $this->em->flush();
        } catch (\Exception $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'Request could not be updated!', 'dispatch:request-not-created', ['message' => $e->getMessage()]);
        }

        return $request;
    }

    public function createRequest(Request $request): Request
    {
        $request->setIdentifier((string) Uuid::v4());

        if ($request->getPersonIdentifier() === null) {
            // we only store the "creator" atm, so, only when the request is created
            $personId = $this->getCurrentPerson()->getIdentifier();
            $request->setPersonIdentifier($personId);
        }

        $request->setDateCreated(new \DateTimeImmutable('now', new DateTimeZone('UTC')));

        try {
            $this->em->persist($request);
            $this->em->flush();
        } catch (\Exception $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'Request could not be created!', 'dispatch:request-not-created', ['message' => $e->getMessage()]);
        }

        return $request;
    }

    public function fetchAndSetPersonData(RequestRecipient $requestRecipient): void
    {
        $personIdentifier = trim($requestRecipient->getPersonIdentifier() ?? '');

        if ($personIdentifier === '') {
            return;
        }

        $options = [];
        Options::requestLocalDataAttributes($options, ['birthDate', 'streetAddress', 'addressLocality', 'postalCode', 'addressCountry']);

        // This already throws an exception if the person is not found
        $person = $this->personProvider->getPerson($personIdentifier, $options);
        $localData = $person->getLocalData();

        $requestRecipient->setGivenName($person->getGivenName());
        $requestRecipient->setFamilyName($person->getFamilyName());
        try {
            $birthDateString = $localData['birthDate'];
            $birthDate = !Tools::isNullOrEmpty($birthDateString) ? new \DateTime($birthDateString) : null;
        } catch (\Exception $e) {
            $birthDate = null;
        }
        $requestRecipient->setBirthDate($birthDate);
        $requestRecipient->setStreetAddress($localData['streetAddress'] ?? '');
        $requestRecipient->setPostalCode($localData['postalCode'] ?? '');
        $requestRecipient->setAddressLocality($localData['addressLocality'] ?? '');
        $requestRecipient->setAddressCountry($localData['addressCountry'] ?? '');
    }

    public function handleRequestRecipientStorage(RequestRecipient $requestRecipient): RequestRecipient
    {
        $this->fetchAndSetPersonData($requestRecipient);
        $requestRecipient->setPostalDeliverable($requestRecipient->hasValidAddress());
        $this->doPreAddressingSoapRequestForRequestRecipient($requestRecipient);

        if ($requestRecipient->getIdentifier() === '') {
            $this->createRequestRecipient($requestRecipient);
        } else {
            if ($requestRecipient->getDispatchRequest()->isSubmitted()) {
                throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Submitted requests cannot be modified!', 'dispatch:request-submitted-read-only');
            }

            $this->updateRequestRecipient($requestRecipient);
        }

        return $requestRecipient;
    }

    public function createRequestRecipient(RequestRecipient $requestRecipient): RequestRecipient
    {
        // A request object needs to be set for the ORM, setting the identifier only will not persist it
        $request = $this->getRequestById($requestRecipient->getDispatchRequestIdentifier());

        $requestRecipient->setIdentifier((string) Uuid::v4());
        $requestRecipient->setAppDeliveryID($this->dd->createAppDeliveryID());
        $requestRecipient->setRequest($request);
        $requestRecipient->setRecipientId('');
        $requestRecipient->setDateCreated(new \DateTimeImmutable('now', new DateTimeZone('UTC')));

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

    public function createRequestFile(File $uploadedFile, string $dispatchRequestIdentifier): RequestFile
    {
        $data = $uploadedFile->getContent();
        $requestFile = new RequestFile();

        // A request object needs to be set for the ORM, setting the identifier only will not persist it
        $requestFile->setDispatchRequestIdentifier($dispatchRequestIdentifier);
        $request = $this->getRequestById($requestFile->getDispatchRequestIdentifier());
        $requestFile->setRequest($request);
        $requestFile->setFileStorageSystem($this->fileStorage);

        $fileName = $uploadedFile instanceof UploadedFile ? $uploadedFile->getClientOriginalName() : $uploadedFile->getFilename();

        // Store the blob file identifier in the database
        if ($this->fileStorage === self::FILE_STORAGE_BLOB) {
            $fileStorageIdentifier = $this->blobService->uploadRequestFile($dispatchRequestIdentifier, $fileName, $data);
            $requestFile->setFileStorageIdentifier($fileStorageIdentifier);
            // We don't want to store the file content in the database
            $data = '';
        }

        $requestFile->setData($data);
        $requestFile->setFileFormat($uploadedFile->getMimeType());
        $requestFile->setContentSize($uploadedFile->getSize());

        $requestFile->setIdentifier((string) Uuid::v4());
        $requestFile->setName($fileName);
        $requestFile->setDateCreated(new \DateTimeImmutable('now', new DateTimeZone('UTC')));

        try {
            $this->em->persist($requestFile);
            $this->em->flush();
        } catch (\Exception $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestFile could not be created!', 'dispatch:request-file-not-created', ['message' => $e->getMessage()]);
        }

        return $requestFile;
    }

    public function createDeliveryStatusChange(string $requestRecipientIdentifier, int $statusType, string $description = '', string $file = null): DeliveryStatusChange
    {
        if (!$description) {
            $description = Vendo::getStatusTypeDescription($statusType);
        }

        $deliveryStatusChange = new DeliveryStatusChange();

        // A request recipient object needs to be set for the ORM, setting the identifier only will not persist it
        $deliveryStatusChange->setDispatchRequestRecipientIdentifier($requestRecipientIdentifier);
        $requestRecipient = $this->getRequestRecipientById($deliveryStatusChange->getDispatchRequestRecipientIdentifier());
        $deliveryStatusChange->setRequestRecipient($requestRecipient);

        $deliveryStatusChange->setIdentifier((string) Uuid::v4());
        $deliveryStatusChange->setDateCreated(new \DateTimeImmutable('now', new DateTimeZone('UTC')));

        $deliveryStatusChange->setStatusType($statusType);
        $deliveryStatusChange->setDescription($description);

        if ($file) {
            $deliveryStatusChange->setFileStorageSystem($this->fileStorage);
            $deliveryStatusChange->setFileFormat(DualDeliveryService::DOCUMENT_MIME_TYPE);
            $deliveryStatusChange->setFileData($file);
        }

        try {
            $this->em->persist($deliveryStatusChange);
            $this->em->flush();
        } catch (\Exception $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'DeliveryStatusChange could not be created!', 'dispatch:request-status-not-created', ['message' => $e->getMessage()]);
        }

        return $deliveryStatusChange;
    }

    public function removeRequestFileById(string $identifier)
    {
        /** @var RequestFile $requestFile */
        $requestFile = $this->em
            ->getRepository(RequestFile::class)
            ->find($identifier);

        if ($requestFile->getFileStorageSystem() === self::FILE_STORAGE_BLOB) {
            $this->blobService->deleteBlobFileByRequestFile($requestFile);
        }

        $this->em->remove($requestFile);
        $this->em->flush();
    }

    /**
     * @param bool $direct          true if the queue should be skipped and the request should be submitted directly
     * @param bool $printRequestXml If true print the request xml to the cli
     *
     * @return void
     */
    public function submitRequest(Request $request, bool $direct = false, bool $printRequestXml = false)
    {
        $request->setDateSubmitted(new \DateTimeImmutable('now', new DateTimeZone('UTC')));
        $this->updateRequest($request);

        $this->createDeliveryStatusChangeForAllRecipientsOfRequest($request, DeliveryStatusChange::STATUS_SUBMITTED, 'Request submitted');

        if ($direct) {
            // Directly submit request
            $this->doDualDeliveryRequestSoapRequest($request, $printRequestXml);
        } else {
            // Put request in queue for submission
            $this->createAndDispatchRequestSubmissionMessage($request);
        }
    }

    public function createDeliveryStatusChangeForAllRecipientsOfRequest(Request $request, int $statusType, string $description)
    {
        foreach ($request->getRecipients() as $recipient) {
            $this->createDeliveryStatusChange($recipient->getIdentifier(), $statusType, $description);
        }
    }

    public function createAndDispatchRequestSubmissionMessage(Request $request): RequestSubmissionMessage
    {
        $message = new RequestSubmissionMessage($request);
        $this->bus->dispatch($message);

        return $message;
    }

    /**
     * Checks if a request is in a state where it can be submitted.
     *
     * @return void
     */
    public function checkRequestReadyForSubmit(Request $request)
    {
        if ($request->isSubmitted()) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Request was already submitted!', 'dispatch:request-already-submitted');
        }

        $requestRecipients = $request->getRecipients();
        if ($requestRecipients->count() === 0) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Request has no recipients!', 'dispatch:request-has-no-recipients');
        }

        $gz = $request->getReferenceNumber();
        if (!Vendo::isValidGZForSubmission($gz)) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, "referenceNumber wasn't set correctly!", 'dispatch:request-invalid-reference-number');
        }

        $name = $request->getName();
        if (trim($name) === '') {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'name must not be empty!', 'dispatch:request-name-empty');
        }

        if ($request->getFiles()->count() === 0) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Request has no files!', 'dispatch:request-has-no-files');
        }

        foreach ($requestRecipients as $requestRecipient) {
            if (!$requestRecipient->isPostalDeliverable() && !$requestRecipient->isElectronicallyDeliverable()) {
                throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Request has a recipient without a delivery method!', 'dispatch:request-has-recipient-without-delivery-method');
            }
        }
    }

    public function handleRequestSubmissionMessage(RequestSubmissionMessage $message)
    {
        $request = $message->getRequest();

        try {
            // Do Vendo API request
            $this->doDualDeliveryRequestSoapRequest($request);
        } catch (\Throwable $e) {
            // TODO: how do we handle when request didn't get through?
            throw new UnrecoverableMessageHandlingException('Request could not be submitted to Vendo!', 0, $e);
        }

        // TODO: Dispatch another delayed message if Vendo request failed? (this isn't even possible now since DualDeliveryRequests are made for each recipient)

        // Don't update this status, because we are doing a real status request to Vendo before it
//        $this->createDeliveryStatusChangeForAllRecipientsOfRequest($request, DeliveryStatusChange::STATUS_IN_PROGRESS, 'Request transferred to Vendo');
    }

    public function doPreAddressingSoapRequest(string $givenName, string $familyName, \DateTimeInterface $birthDate): DualDeliveryPreAddressingResponseType
    {
        $service = $this->dd->getClient();
        $recipientId = $this->dd->createRecipientId();
        $appDeliveryId = $this->dd->createAppDeliveryID();

        $personName = new PersonNameType($givenName, new FamilyName($familyName));
        $physicalPerson = new PhysicalPersonType($personName, $birthDate ? $birthDate->format('Y-m-d') : null);
        $senderProfile = $this->dd->getSenderProfile();
        $sender = new SenderType($senderProfile);
        $recipientData = new PersonDataType($physicalPerson);
        $recipientType = new RecipientType($recipientData);
        $channels = null;

        $recipients = new Recipients([new Recipient($recipientId, $recipientType)]);
        $testCase = false;
        $processingProfile = new ProcessingProfile('ZuseDD', '1.1');
        $request = new DualDeliveryPreAddressingRequestType(
            $sender,
            $recipients,
            new PreMetaData(
                $appDeliveryId,
                null,
                null,
                $testCase,
                $processingProfile,
                false,
                true),
            $channels,
            '1.0'
        );

        try {
            $response = $service->dualDeliveryPreAddressingRequestOperation($request);
        } catch (\Exception $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'PreAddressing request failed!', 'dispatch:request-pre-addressing-failed', ['message' => $e->getMessage()]);
        }

        if ($response->getStatus()->getText() !== 'SUCCESS') {
            /* @var ErrorType[] $errors */
            $errors = $response->getErrors()->getError();
            $errorTexts = [];

            foreach ($errors as $error) {
                $errorTexts[] = $error->getInfo();
            }

            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'PreAddressing request failed!', 'dispatch:request-pre-addressing-failed', ['message' => implode(', ', $errorTexts)]);
        }

        return $response;
    }

    public function doPreAddressingSoapRequestForPreAddressingRequest(PreAddressingRequest &$preAddressingRequest)
    {
        $response = $this->doPreAddressingSoapRequest($preAddressingRequest->getGivenName(), $preAddressingRequest->getFamilyName(), $preAddressingRequest->getBirthDate());

        // TODO: Respond in another way?
        $addressingResults = $response->getAddressingResults()->getAddressingResult();
        if (count($addressingResults) === 0) {
            throw ApiError::withDetails(Response::HTTP_NOT_FOUND, 'Person was not found!', 'dispatch:request-pre-addressing-not-found', ['message' => 'No addressing results found!']);
        }

        $preAddressingRequest->setDualDeliveryID($addressingResults[0]->getDualDeliveryID());
    }

    public function doPreAddressingSoapRequestForRequestRecipient(RequestRecipient $requestRecipient)
    {
        if (!$requestRecipient->canDoPreAddressingRequest()) {
            $requestRecipient->setElectronicallyDeliverable(false);

            return;
        }

        $response = $this->doPreAddressingSoapRequest($requestRecipient->getGivenName(), $requestRecipient->getFamilyName(), $requestRecipient->getBirthDate());

        $addressingResults = $response->getAddressingResults();
        $addressingResultData = $addressingResults->getAddressingResult() ?? [];
        $requestRecipient->setElectronicallyDeliverable(count($addressingResultData) > 0);
    }

    public function doDualDeliveryStatusRequestSoapRequest(RequestRecipient $recipient): bool
    {
        $service = $this->dd->getClient();
        $appDeliveryId = $recipient->getAppDeliveryID();
        $statusRequest = new StatusRequestType(null, $appDeliveryId);
        $this->logInfo('Doing status request', [
            'recipient-id' => $recipient->getIdentifier(),
        ]);

        try {
            $response = $service->dualStatusRequestOperation($statusRequest);
        } catch (\Exception $e) {
            $this->createDeliveryStatusChange($recipient->getIdentifier(),
                DeliveryStatusChange::STATUS_SOAP_ERROR, 'StatusRequest Soap error: '.$e->getMessage());

            throw ApiError::withDetails(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                'DualDelivery status request failed!',
                'dispatch:status-request-soap-error',
                [
                    'recipient-id' => $recipient->getIdentifier(),
                    'message' => $e->getMessage(),
                ]
            );
        }

        $code = $response->getStatus()->getCode();
        $status = Vendo::getStatusForCode($code);

        $lastStatusChange = $this->getLastStatusChange($recipient);

        // Check if there is a status change
        if ($lastStatusChange !== null && $lastStatusChange->getStatusType() === $status) {
            return false;
        }

        if ($status === 0) {
            $this->createDeliveryStatusChange($recipient->getIdentifier(),
                DeliveryStatusChange::STATUS_STATUS_REQUEST_FAILED, 'StatusRequest request failed: StatusCode "'.$code.'" not found');

            $this->logWarning('StatusCode of StatusRequest not found!', [
                'recipient-id' => $recipient->getIdentifier(),
                'code' => $code,
            ]);

            throw ApiError::withDetails(
                Response::HTTP_INTERNAL_SERVER_ERROR, 'StatusRequest request failed!', 'dispatch:status-request-failed', [
                    'recipient-id' => $recipient->getIdentifier(),
                    'message' => 'StatusCode not found',
                ]
            );
        }

        $description = $this->getDeliveryStatusChangeDescription($response);
        $file = DualDeliveryService::getPdfFromDeliveryNotification($response);
        $unclaimedDescription = DualDeliveryService::getDeliveryNotificationForUnclaimedDescription($response);
        if ($unclaimedDescription !== null) {
            $description .= "\n".$unclaimedDescription;
        }

        $statusChange = $this->createDeliveryStatusChange($recipient->getIdentifier(), $status, $description, $file);

        // Set the end date for the recipient if the status is final
        if ($statusChange->isFinalDualDeliveryStatus()) {
            $this->setRecipientDeliveryEndDate($recipient);
        }

        return true;
    }

    public function doDualDeliveryStatusRequestSoapRequestForAppDeliveryId(string $appDeliveryId, bool $printResponseXml = false): DualNotificationRequestType
    {
        $service = $this->dd->getClient();
        $statusRequest = new StatusRequestType(null, $appDeliveryId);

        try {
            $response = $service->dualStatusRequestOperation($statusRequest);

            if ($printResponseXml) {
                echo $service->getPrettyLastResponse();
            }
        } catch (\Exception $e) {
            throw ApiError::withDetails(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                'DualDelivery status request failed!',
                'dispatch:status-request-soap-error',
                [
                    'message' => $e->getMessage(),
                ]
            );
        }

        return $response;
    }

    public function getDeliveryStatusChangeDescription(DualNotificationRequestType $response): string
    {
        $code = $response->getStatus()->getCode();
        $status = Vendo::getStatusForCode($code);

        // First get the static status description
        $description = Vendo::getStatusTypeDescription($status);

        // Try to add the status text from the response
        $statusText = $response->getStatus()->getText();
        if ($statusText) {
            $description .= "\n".$statusText;
        }

        // Try to add the error text from the response
        $errorText = DualDeliveryService::getErrorTextFromStatusResponse($response);
        if ($errorText) {
            $description .= "\n".$errorText;
        }

        return $description;
    }

    /**
     * @param bool $printRequestXml If true print the request xml to the cli
     */
    public function doDualDeliveryRequestSoapRequest(Request &$dispatchRequest, bool $printRequestXml = false): bool
    {
        $service = $this->dd->getClient();
        $dualDeliveryPayloads = [];

        /** @var RequestFile[] $files */
        $files = $dispatchRequest->getFiles();

        // For some reasons files are not loaded by default
        if (count($files) === 0) {
            $files = $this->getRequestFilesByRequestId($dispatchRequest->getIdentifier());
            $this->logWarning('Request had no files and files were reloaded!', [
                'recipient-id' => $dispatchRequest->getIdentifier(),
            ]);
        }

        foreach ($files as $file) {
            $payloadAttrs = new PayloadAttributesType($file->getName(), $file->getFileFormat());
            $payloadAttrs->setSize($file->getContentSize());
            // Id must not start with a number (says trial & error, xsd:ID or xs:NCName spec don't tell)!
            $payloadAttrs->setId('file-'.$file->getIdentifier());

            // $content is base64 encoded by the SOAP library!
            $content = $file->getData();

            // Attempt to re-read the file if content is empty
            if ($content === null || $content === 0) {
                $file = $this->getRequestFileById($file->getIdentifier());
                $content = $file->getData();
                $this->logWarning('Content of file was empty and reloaded!', [
                    'file-id' => $file->getIdentifier(),
                ]);
            }

            $md5 = md5($content);
            $checksum = new Checksum('MD5', $md5);
            $payloadAttrs->setChecksum($checksum);

            $doc = new BinaryDocumentType($content);
            $dualDeliveryPayloads[] = new PayloadType($payloadAttrs, $doc);
        }

        //
        // Set sender data with organization and address
        //
        $senderProfile = $this->dd->getSenderProfile();
        $senderFullName = trim($dispatchRequest->getSenderFullName() ?? '');
        $senderOrganizationName = trim($dispatchRequest->getSenderOrganizationName() ?? '');

        if ($senderFullName === '') {
            $senderFullName = $senderOrganizationName;
            $senderOrganizationName = '';
        }

        if ($senderFullName !== '') {
            $corporateBody = new CorporateBodyType($senderFullName);

            if ($senderOrganizationName !== '') {
                $corporateBody->setOrganization($senderOrganizationName);
            }

            $senderPostalAddress = new PostalAddressType(
                null,
                $dispatchRequest->getSenderPostalCode(),
                $dispatchRequest->getSenderAddressLocality(),
                new DeliveryAddress(
                    $dispatchRequest->getSenderStreetAddress(),
                    $dispatchRequest->getSenderBuildingNumber()
                )
            );

            $senderPostalAddress->setCountryCode($dispatchRequest->getSenderAddressCountry());

            // $senderPostalAddress disabled, because we still get an exception from Vendo:
            // cvc-complex-type.2.4.b: The content of element 'ElectronicAddresses' is not complete.
            // One of '{\\\"http:\\/\\/www.plot.at\\/mprs\\/bean\\/v10\\/core\\\":ElectronicAddress}' is expected.
            // Update 2023-02-23: cbp has fixed the issue now
//            $senderPostalAddress = null;

            $senderData = new SenderData($corporateBody, $senderPostalAddress);
        } else {
            $senderData = null;
        }

        $sender = new SenderType($senderProfile, $senderData);

        // TODO: Allow to set this via request (limited by config, STRETCH_GOAL)
//        $processingProfile = new ProcessingProfile('ZuseDD', '1.0');
        $processingProfile = new ProcessingProfile(VendoProcessingProfile::ZUSE_PRINT_HYBRID_DD, '1.0');
        // TODO: Allow to set this via config/request (STRETCH_GOAL)
        $deliveryQuality = DeliveryQuality::RSA;
        $gz = $dispatchRequest->getReferenceNumber();

        /** @var RequestRecipient $recipient */
        foreach ($dispatchRequest->getRecipients() as $recipient) {
            $personName = new PersonNameType($recipient->getGivenName(), new FamilyName($recipient->getFamilyName()));
            $birthDate = $recipient->getBirthDate();
            $physicalPerson = new PhysicalPersonType($personName, $birthDate ? $birthDate->format('Y-m-d') : null);

            $postalCode = trim($recipient->getPostalCode() ?? '');
            $addressLocality = trim($recipient->getAddressLocality() ?? '');
            $streetAddress = trim($recipient->getStreetAddress() ?? '');
            $buildingNumber = trim($recipient->getBuildingNumber() ?? '');
            $addressCountry = trim($recipient->getAddressCountry() ?? '');

            // country must not be empty, or else you will get a SOAP error:
            // cvc-pattern-valid: Value '' is not facet-valid with respect to pattern '[A-Z]{2}' for type '#AnonType_CountryCodePostalAddressType'.
            if ($addressCountry === '') {
                $addressCountry = 'AT';
            }

//            if ($postalCode !== '' && $addressLocality !== '' && $streetAddress !== '' && $addressCountry !== '') {
            $address = new PostalAddressType(null, $postalCode, $addressLocality, new DeliveryAddress($streetAddress, $buildingNumber));
            $address->setCountryCode($addressCountry);
//            } else {
//                $address = null;
//            }

            $personData = new PersonDataType($physicalPerson, $address);
            $name = $dispatchRequest->getName();

            $dualDeliveryRecipient = new RecipientType($personData);

            $id = $recipient->getAppDeliveryID();
            $meta = new DualDeliveryMetaData(
                $id,
                null,
                $deliveryQuality,
                $name,
                $gz,
                null,
                null,
                false,
                $processingProfile,
                null,
                true
            );

            $request = new DualDeliveryRequest($sender, null, $dualDeliveryRecipient, $meta, null, $dualDeliveryPayloads, '1.0');

            try {
                $response = $service->dualDeliveryRequestOperation($request);

                // Needs to be printed directly because if there is an exception the request xml can't be returned
                if ($printRequestXml) {
                    echo $service->getPrettyLastRequest();
                }
            } catch (\Exception $e) {
                if ($printRequestXml) {
                    echo $service->getPrettyLastRequest();
                }
                $this->createDeliveryStatusChange($recipient->getIdentifier(),
                    DeliveryStatusChange::STATUS_SOAP_ERROR, 'DualDeliveryRequest Soap error: '.$e->getMessage());

                throw ApiError::withDetails(
                    Response::HTTP_INTERNAL_SERVER_ERROR,
                    'DualDelivery request failed!',
                    'dispatch:dual-delivery-request-soap-error',
                    [
                        'request-id' => $dispatchRequest->getIdentifier(),
                        'recipient-id' => $recipient->getIdentifier(),
                        'message' => $e->getMessage(),
                    ]
                );
            }

            if ($response->getStatus()->getText() !== 'SUCCESS') {
                /* @var ErrorType[] $errors */
                $errors = $response->getErrors()->getError();
                $errorTexts = [];

                foreach ($errors as $apiError) {
                    $errorTexts[] = $apiError->getInfo();
                }

                $errorText = implode(', ', $errorTexts);
                $this->createDeliveryStatusChange($recipient->getIdentifier(),
                    DeliveryStatusChange::STATUS_DUAL_DELIVERY_REQUEST_FAILED, 'DualDelivery request failed: '.$errorText);

                // TODO: Should we really exit with an error here or continue with other recipients?
                throw ApiError::withDetails(
                    Response::HTTP_INTERNAL_SERVER_ERROR, 'DualDelivery request failed!', 'dispatch:dual-delivery-request-failed', [
                        'request-id' => $dispatchRequest->getIdentifier(),
                        'recipient-id' => $recipient->getIdentifier(),
                        'message' => $errorText,
                    ]
                );
            }

            $this->createDeliveryStatusChange($recipient->getIdentifier(),
                DeliveryStatusChange::STATUS_DUAL_DELIVERY_REQUEST_SUCCESS, 'DualDelivery request submitted');

            // Directly update the dualDeliveryID instead of using the ORM, because we had errors like:
            //
            // A new entity was found through the relationship 'Dbp\\\\Relay\\\\DispatchBundle\\\\Entity\\\\RequestRecipient#request'
            // that was not configured to cascade persist operations for entity: Dbp\\\\Relay\\\\DispatchBundle\\\\Entity\\\\Request@658.
            // To solve this issue: Either explicitly call EntityManager#persist() on this unknown entity or configure cascade persist
            // this association in the mapping for example @ManyToOne(..,cascade={\\\"persist\\\"}). If you cannot find out which entity
            // causes the problem implement 'Dbp\\\\Relay\\\\DispatchBundle\\\\Entity\\\\Request#__toString()' to get a clue.
            $queryBuilder = $this->em->createQueryBuilder();
            $query = $queryBuilder->update(RequestRecipient::class, 'r')
                ->set('r.dualDeliveryID', ':dualDeliveryId')
                ->where('r.identifier = :identifier')
                ->setParameter('identifier', $recipient->getIdentifier())
                ->setParameter('dualDeliveryId', $response->getDualDeliveryID())
                ->getQuery();

            try {
                $query->execute();
            } catch (\Exception $e) {
                throw ApiError::withDetails(
                    Response::HTTP_INTERNAL_SERVER_ERROR, 'DualDeliveryId of RequestRecipient could not be updated after DualDelivery request!',
                    'dispatch:request-recipient-not-updated', [
                        'request-id' => $dispatchRequest->getIdentifier(),
                        'recipient-id' => $recipient->getIdentifier(),
                        'dual-delivery-id' => $response->getDualDeliveryID(),
                        'message' => $e->getMessage(),
                    ]
                );
            }

            $this->doDualDeliveryStatusRequestSoapRequest($recipient);
        }

        return true;
    }

    public function doStatusRequests()
    {
        $recipients = $this->getNotFinishedRequestRecipients();

        foreach ($recipients as $recipient) {
            try {
                $this->doDualDeliveryStatusRequestSoapRequest($recipient);
            } catch (\Exception $e) {
                $this->logWarning('Error while doing status request!', [
                    'recipient-id' => $recipient->getIdentifier(),
                    'exception' => $e,
                ]);
            }
        }
    }

    public function getLastStatusChange(RequestRecipient $recipient): ?DeliveryStatusChange
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $query = $queryBuilder->select('dsc')
            ->from(DeliveryStatusChange::class, 'dsc')
            ->where('dsc.requestRecipient = :requestRecipient')
            ->orderBy('dsc.dateCreated', 'DESC')
            ->setMaxResults(1)
            ->setParameter('requestRecipient', $recipient)
            ->getQuery();

        return $query->getOneOrNullResult();
    }

    protected function setRecipientDeliveryEndDate(RequestRecipient $recipient)
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $query = $queryBuilder->update(RequestRecipient::class, 'r')
            ->set('r.deliveryEndDate', ':deliveryEndDate')
            ->where('r.identifier = :identifier')
            ->setParameter('identifier', $recipient->getIdentifier())
            ->setParameter('deliveryEndDate', new \DateTimeImmutable('now', new DateTimeZone('UTC')))
            ->getQuery();

        try {
            $query->execute();
        } catch (\Exception $e) {
            throw ApiError::withDetails(
                Response::HTTP_INTERNAL_SERVER_ERROR, 'DeliveryEndDate of RequestRecipient could not be set!',
                'dispatch:request-recipient-delivery-end-date-not-set', [
                    'recipient-id' => $recipient->getIdentifier(),
                    'message' => $e->getMessage(),
                ]
            );
        }
    }

    protected function log($level, string $message, array $context = [])
    {
        $context['service'] = 'dispatch';
        $this->logger->log($level, $message, $context);
    }

    protected function logWarning(string $message, array $context = [])
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    protected function logInfo(string $message, array $context = [])
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    protected function logError(string $message, array $context = [])
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }
}
