<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use DateTimeZone;
use Dbp\Relay\BasePersonBundle\API\PersonProviderInterface;
use Dbp\Relay\BasePersonBundle\Entity\Person;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\BinaryDocumentType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\Checksum;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\DualDeliveryRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ErrorType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\MetaData as DualDeliveryMetadata;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\PayloadAttributesType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\PayloadType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ProcessingProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\RecipientType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\SenderType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification\StatusRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\DualDeliveryPreAddressingRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\MetaData as PreMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\Recipient;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\Recipients;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse\DeliveryAddress;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse\PersonDataType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse\PersonNameType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse\PhysicalPersonType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse\PostalAddressType;
use Dbp\Relay\DispatchBundle\Entity\DeliveryStatusChange;
use Dbp\Relay\DispatchBundle\Entity\PreAddressingRequest;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Message\RequestSubmissionMessage;
use Dbp\Relay\DispatchBundle\Traits\DOMMethodsTrait;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Cache\CacheItemPoolInterface;
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
    use DOMMethodsTrait;

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
    private $baseUrl;

    /**
     * @var string
     */
    private $deliveryRequestUrl;

    /**
     * @var string
     */
    private $preAddressingRequestUrl;

    /**
     * @var string
     */
    private $statusRequestUrl;

    /**
     * @var DualDeliveryService
     */
    private $dd;

    public function __construct(
        PersonProviderInterface $personProvider,
        ManagerRegistry $managerRegistry,
        MessageBusInterface $bus,
        DualDeliveryService $dd
    ) {
        $this->personProvider = $personProvider;
        $manager = $managerRegistry->getManager('dbp_relay_dispatch_bundle');
        assert($manager instanceof EntityManagerInterface);
        $this->em = $manager;
        $this->bus = $bus;
        $this->dd = $dd;
        $this->logger = new NullLogger();
    }

    public function setConfig(array $config)
    {
        $this->certPassword = $config['cert_password'] ?? '';
        $this->cert = $config['cert'] ?? '';
        $this->baseUrl = $config['base_url'];
        $this->deliveryRequestUrl = $config['base_url'].$config['delivery_request_url_part'];
        $this->preAddressingRequestUrl = $config['base_url'].$config['pre_addressing_request_url_part'];
        $this->statusRequestUrl = $config['base_url'].$config['status_request_url_part'];
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
    public function getRequestById(string $identifier): Request
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

        return $requests;
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

        // we only store the "creator" atm, so, only when the request is created
        $personId = $this->getCurrentPerson()->getIdentifier();
        $request->setPersonIdentifier($personId);

        try {
            $request->setDateCreated(new \DateTimeImmutable('now', new DateTimeZone('UTC')));
        } catch (\Exception $e) {
        }

        try {
            $this->em->persist($request);
            $this->em->flush();
        } catch (\Exception $e) {
            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'Request could not be created!', 'dispatch:request-not-created', ['message' => $e->getMessage()]);
        }

        return $request;
    }

    public function createRequestRecipient(RequestRecipient $requestRecipient): RequestRecipient
    {
        // A request object needs to be set for the ORM, setting the identifier only will not persist it
        $request = $this->getRequestById($requestRecipient->getDispatchRequestIdentifier());

        $requestRecipient->setIdentifier((string) Uuid::v4());
        $requestRecipient->setRequest($request);
        $requestRecipient->setRecipientId('');
        try {
            $requestRecipient->setDateCreated(new \DateTimeImmutable('now', new DateTimeZone('UTC')));
        } catch (\Exception $e) {
        }

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

        $requestFile->setIdentifier((string) Uuid::v4());
        $requestFile->setName($uploadedFile instanceof UploadedFile ? $uploadedFile->getClientOriginalName() : $uploadedFile->getFilename());
        $requestFile->setData($data);
        $requestFile->setFileFormat($uploadedFile->getMimeType());
        $requestFile->setContentSize($uploadedFile->getSize());
        try {
            $requestFile->setDateCreated(new \DateTimeImmutable('now', new DateTimeZone('UTC')));
        } catch (\Exception $e) {
        }

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
        if ($description === '') {
            $description = self::getStatusTypeDescription($statusType);
        }

        $deliveryStatusChange = new DeliveryStatusChange();

        // A request recipient object needs to be set for the ORM, setting the identifier only will not persist it
        $deliveryStatusChange->setDispatchRequestRecipientIdentifier($requestRecipientIdentifier);
        $requestRecipient = $this->getRequestRecipientById($deliveryStatusChange->getDispatchRequestRecipientIdentifier());
        $deliveryStatusChange->setRequestRecipient($requestRecipient);

        $deliveryStatusChange->setIdentifier((string) Uuid::v4());
        try {
            $deliveryStatusChange->setDateCreated(new \DateTimeImmutable('now', new DateTimeZone('UTC')));
        } catch (\Exception $e) {
        }

        $deliveryStatusChange->setStatusType($statusType);
        $deliveryStatusChange->setDescription($description);

        if ($file) {
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

        $this->em->remove($requestFile);
        $this->em->flush();
    }

    public function submitRequest(Request $request)
    {
        try {
            $request->setDateSubmitted(new \DateTimeImmutable('now', new DateTimeZone('UTC')));
        } catch (\Exception $e) {
            $request->setDateSubmitted(new \DateTimeImmutable('now'));
        }
        $this->updateRequest($request);

        $this->createDeliveryStatusChangeForAllRecipientsOfRequest($request, DeliveryStatusChange::STATUS_SUBMITTED, 'Request submitted');

        // Put request in queue for submission
        $this->createAndDispatchRequestSubmissionMessage($request);
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

        if ($request->getRecipients()->count() === 0) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Request has no recipients!', 'dispatch:request-has-no-recipients');
        }

        if ($request->getFiles()->count() === 0) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'Request has no files!', 'dispatch:request-has-no-files');
        }
    }

    public function handleRequestSubmissionMessage(RequestSubmissionMessage $message)
    {
        $request = $message->getRequest();
//        dump($request);

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

    public function doPreAddressingSoapRequest(PreAddressingRequest &$preAddressingRequest)
    {
        $service = $this->dd->getClient();

        $personName = new PersonNameType($preAddressingRequest->getGivenName(), $preAddressingRequest->getFamilyName());
        $physicalPerson = new PhysicalPersonType($personName, $preAddressingRequest->getBirthDate()->format('Y-m-d'));
        $senderProfile = $this->dd->getSenderProfile();
        $sender = new SenderType($senderProfile);
        $recipientData = new PersonDataType($physicalPerson);
//        $parameters = new ParametersType(new ParameterType('bla', 'foo'));
        $recipientType = new RecipientType($recipientData);

//        $channels = new DeliveryChannels(new DeliveryChannelSetType());
        $channels = null;

        $recipients = new Recipients([new Recipient($preAddressingRequest->getIdentifier(), $recipientType)]);
        $testCase = false;
        $processingProfile = new ProcessingProfile('ZuseDD', '1.1');
        $request = new DualDeliveryPreAddressingRequestType(
            $sender,
            $recipients,
            new PreMetaData(
                $preAddressingRequest->getIdentifier(),
                null,
                null,
                $testCase,
                $processingProfile,
                false,
                true),
            $channels,
            '1.0'
        );
//        dump($request);
//        dump('baseUrl');
//        dump($this->baseUrl);
//        dump($this->cert);
//        dump($this->certPassword);
        $response = $service->dualDeliveryPreAddressingRequestOperation($request);

//        dump($response);
//        dump($service->getPrettyLastRequest());
//        dump($service->getPrettyLastResponse());

        if ($response->getStatus()->getText() !== 'SUCCESS') {
            /* @var ErrorType[] $errors */
            $errors = $response->getErrors()->getError();
            $errorTexts = [];

            foreach ($errors as $error) {
                $errorTexts[] = $error->getInfo();
            }

            throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'PreAddressing request failed!', 'dispatch:request-pre-addressing-failed', ['message' => implode(', ', $errorTexts)]);
        }

        // TODO: Respond in another way?
        $addressingResults = $response->getAddressingResults()->getAddressingResult();
        if ($addressingResults === null || count($addressingResults) === 0) {
            throw ApiError::withDetails(Response::HTTP_NOT_FOUND, 'Person was not found!', 'dispatch:request-pre-addressing-not-found', ['message' => 'No addressing results found!']);
        }

        $preAddressingRequest->setDualDeliveryID($addressingResults[0]->getDualDeliveryID());
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
                'DualDelivery request failed!',
                'dispatch:status-request-soap-error',
                [
                    'recipient-id' => $recipient->getIdentifier(),
                    'message' => $e->getMessage(),
                ]
            );
        }

//        dump('baseUrl');
//        dump($this->baseUrl);
//        dump($response);
//        dump($service->getPrettyLastRequest());
//        dump($service->getPrettyLastResponse());

        $code = $response->getStatus()->getCode();
//        $response->getResult()->getNotificationChannel()->getNotificationChannelSet()
        $status = $this->getStatusForCode($code);

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
                Response::HTTP_INTERNAL_SERVER_ERROR, 'StatusRequest request failed!', 'dispatch:dual-delivery-request-failed', [
                    'recipient-id' => $recipient->getIdentifier(),
                    'message' => 'StatusCode not found',
                ]
            );
        }

        $file = $status === DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P6 ?
            DualDeliveryService::getPdfFromDeliveryNotification($response) : null;
        $description = DualDeliveryService::getErrorTextFromStatusResponse($response);

        $statusChange = $this->createDeliveryStatusChange($recipient->getIdentifier(), $status, $description, $file);

        // Set the end date for the recipient if the status is final
        if ($statusChange->isFinalDualDeliveryStatus()) {
            $this->setRecipientDeliveryEndDate($recipient);
        }

        return true;
    }

    public function doDualDeliveryRequestSoapRequest(Request &$dispatchRequest): bool
    {
        $service = $this->dd->getClient();
        $dualDeliveryPayloads = [];

        /** @var RequestFile[] $files */
        $files = $dispatchRequest->getFiles();
//        dump('$files');
//        dump($files);

        // For some reasons files are not loaded by default
        if (count($files) === 0) {
            $files = $this->getRequestFilesByRequestId($dispatchRequest->getIdentifier());
            $this->logWarning('Request had no files and files were reloaded!', [
                'recipient-id' => $dispatchRequest->getIdentifier(),
            ]);
        }

//        dump('$files2');
//        dump($files);
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

//        $recipients = new Recipients($recipients);
//        $applicationId = new ApplicationID($profile, '1.0');
//        $meta->setApplicationID($applicationId);
        $senderProfile = $this->dd->getSenderProfile();
        $sender = new SenderType($senderProfile);

        // TODO: Allow to set this via request (limited by config, STRETCH_GOAL)
//        $processingProfile = new ProcessingProfile('ZuseDD', '1.0');
        $processingProfile = new ProcessingProfile('ZusePrintHybridDD', '1.0');
        // TODO: Allow to set this via config/request (STRETCH_GOAL)
        $deliveryQuality = 'Rsa';
        // GZ: Über dieses Element kann eine Geschäftszahl bzw. ein Geschäftskennzeichen
        // für Anzeige und Druck mitgegeben werden, welches eine leichtere Lesbarkeit auf
        // Ausdrucken bzw. Benachrichtigungen gewährleisten soll. Im Gegensatz zur
        // AppDeliveryID ist in diesem Fall die technische Eindeutigkeit über das duale
        // Zustellservice nicht zwingend erforderlich.
        $gz = null;

        /** @var RequestRecipient $recipient */
        foreach ($dispatchRequest->getRecipients() as $recipient) {
            $personName = new PersonNameType($recipient->getGivenName(), $recipient->getFamilyName());
            $physicalPerson = new PhysicalPersonType($personName, $recipient->getBirthDate()->format('Y-m-d'));

            $postalCode = trim($recipient->getPostalCode());
            $addressLocality = trim($recipient->getAddressLocality());
            $streetAddress = trim($recipient->getStreetAddress());
            $buildingNumber = trim($recipient->getBuildingNumber());
            $addressCountry = trim($recipient->getAddressCountry());

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
            $name = trim($dispatchRequest->getName());
            $subject = $name !== '' ? $name : 'Zustellung';
            $dualDeliveryRecipient = new RecipientType($personData);

            $id = $recipient->getAppDeliveryID();
//            $id = $recipient->getAppDeliveryID().'-pbek-'.rand(100000, 999999);
            $meta = new DualDeliveryMetaData(
                $id,
                null,
                $deliveryQuality,
                $subject,
                $gz,
                null,
                null,
                false,
                $processingProfile,
                null,
                true
            );
//            dump($dualDeliveryRecipients);
            $request = new DualDeliveryRequest($sender, null, $dualDeliveryRecipient, $meta, null, $dualDeliveryPayloads, '1.0');
//            dump($request);

            try {
                $response = $service->dualDeliveryRequestOperation($request);
            } catch (\Exception $e) {
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

//            dump('baseUrl');
//            dump($this->baseUrl);
//            dump($this->cert);
//            dump($this->certPassword);

//            dump($response);
//            dump($service->getPrettyLastRequest());
//            dump($service->getPrettyLastResponse());

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
                $result = $query->execute();
//                dump($result);
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

//            $recipient->setDualDeliveryID($response->getDualDeliveryID());
//
//            try {
//                $this->em->persist($recipient);
//                $this->em->flush();
//            } catch (\Exception $e) {
//                throw ApiError::withDetails(
//                    Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestRecipient could not be update after DualDelivery request!',
//                    'dispatch:request-recipient-not-updated', [
//                        'request-id' => $dispatchRequest->getIdentifier(),
//                        'recipient-id' => $recipient->getIdentifier(),
//                        'message' => $e->getMessage(),
//                    ]
//                );
//            }

            $this->doDualDeliveryStatusRequestSoapRequest($recipient);
        }

        return true;
    }

    protected function getStatusForCode(string $code): int
    {
        $statusType = 0;

        switch ($code) {
            case '17':
                $statusType = DeliveryStatusChange::STATUS_DUAL_DELIVERY_APPLICATION_ID_NOT_FOUND;
                break;
            case 'P1':
                $statusType = DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P1;
                break;
            case 'P2':
                $statusType = DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P2;
                break;
            case 'P3':
                $statusType = DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P3;
                break;
            case 'P4':
                $statusType = DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P4;
                break;
            case 'P5':
                $statusType = DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P5;
                break;
            case 'P6':
                $statusType = DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P6;
                break;
            case 'P7':
                $statusType = DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P7;
                break;
            case 'P8':
                $statusType = DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P8;
                break;
            case 'P9':
                $statusType = DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P9;
                break;
            case 'P10':
                $statusType = DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P10;
                break;
            case 'P11':
                $statusType = DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P11;
                break;
            case 'P12':
                $statusType = DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P12;
                break;
        }

        return $statusType;
    }

    public static function getStatusTypeDescription(int $status): string
    {
        // The P* codes are textual explanation for status code from DeliveryQuality_ProcessingProfile_Statuswerte_v1.1.0.xlsx
        $descriptions = [
            DeliveryStatusChange::STATUS_DUAL_DELIVERY_APPLICATION_ID_NOT_FOUND => 'ApplicationID wurde nicht gefunden',
            DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P1 => 'P1: Addressierbarkeit wird geprüft',
            DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P2 => 'P2: Datenanreicherung des Geschäftsfalles',
            DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P3 => 'P3: Geschäftsfall wird zugestellt',
            DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P4 => "P4: Geschäftsfall teilweise zugestellt\nDer Geschäftsfall wurde von der Applikation an den Zustellservice übertragen. Keine Bestätigung vom Zustelldienst erhalten, ein erneuter Versuch erfolgt.",
            DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P5 => "P5: Geschäftsfall erfolgreich übermittelt\nDer Geschäftsfall wurde von der Applikation an den Zustellservice übertragen.",
            DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P6 => 'P6: Alle Nachweise erhalten von allen Kanälen',
            DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P7 => 'P7: Geschäftfall wird verarbeitet',
            DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P8 => "P8: Empfänger konnte nicht ermittelt werden\nnegative Antwort vom zentralen Adressverzeichnis (Zustellkopf), mit den übergebenen Informationen konnte keine eindeutige Person identifiziert werden",
            DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P9 => "P9: Zustellung konnte nicht erfolgreich verarbeitet/zugestellt werden\nMögliche Gründe: fehlende Adressierungsmerkmale, keine Fristgerechte Antwort von Druckstrasse erhalten.",
            DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P10 => "P10: Geschäftfall erfolgreich zugestellt\nGeschäftsfall ist beim Empfängerpostfach am Zustelldienst hinterlegt bzw. von der Druckstrasse produziert worden.",
            DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P11 => 'P11: Nachweise befindet sich im Zulauf',
            DeliveryStatusChange::STATUS_DUAL_DELIVERY_STATUS_P12 => 'P12: Fehler aufgetreten, bitte kontaktieren Sie den Support',
        ];

        return $descriptions[$status] ?? '';
    }

    public function doStatusRequests()
    {
        $recipients = $this->getNotFinishedRequestRecipients();

        foreach ($recipients as $recipient) {
            try {
                $this->doDualDeliveryStatusRequestSoapRequest($recipient);
            } catch (\Exception $e) {
//                dump($e);
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
            $result = $query->execute();
//            dump($result);
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

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    protected function logError(string $message, array $context = [])
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }
}
