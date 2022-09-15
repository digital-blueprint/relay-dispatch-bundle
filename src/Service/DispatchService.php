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
use GuzzleHttp\Exception\RequestException;
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

    /**
     * @var string
     */
    private $senderProfile;

    /**
     * @var string
     */
    private $certPassword;

    /**
     * @var string
     */
    private $certP12Base64;

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

    public function setConfig(array $config)
    {
        $this->senderProfile = $config['sender_profile'] ?? '';
        $this->certPassword = $config['cert_password'] ?? '';
        $this->certP12Base64 = $config['cert_p12'] ?? '';
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
    public function getRequestByIdForCurrentPerson(string $identifier): Request
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
        $request = $message->getRequest();

        // TODO: Do Vendo API request
        dump($request);
        // Dispatch another delayed message if Vendo request failed
        $this->createRequestStatusChange($request->getIdentifier(), RequestStatusChange::STATUS_IN_PROGRESS, 'Request transferred to Vendo');
    }

    public function doAPIRequest($url, $body)
    {
        $client = new \GuzzleHttp\Client();
        $password = $this->certPassword;
        $useCert = $this->certPassword !== '' && $this->certP12Base64 !== '';
        $certFileName = '';

        if ($useCert) {
            $tmpDir = sys_get_temp_dir();
            $certFileName = tempnam($tmpDir, 'dispatch');

            if ($certFileName === false) {
                throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'Could not create temporary cert file!', 'dispatch:temp-cert-error');
            }

//            var_dump(base64_decode($this->certP12Base64));
//            var_dump($certFileName);

            $certData = base64_decode($this->certP12Base64, true);

            if ($certData === false) {
                throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'Cert data could not be decoded!', 'dispatch:base64-cert-error');
            }

            // TODO: it seems that this file can't be used in the request, it's not a valid cert file. maybe use 2nd temp file?
            file_put_contents($certFileName, $certData, LOCK_EX);
//            copy($certFileName, './tu_graz_client.kbprintcom.at_.p12');
//            copy($certFileName, '/tmp/tu_graz_client.kbprintcom.at_.p12');
        }

//        $certFileName = './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.p12';
//        $certFileName = './tu_graz_client.kbprintcom.at_.p12';
//        $certFileName = '/tmp/tu_graz_client.kbprintcom.at_.p12';
//        $certFileName = "./vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.crt.pem";
        $uri = 'https://dualtest.vendo.at/mprs-core/services10/DDWebServiceProcessor';
        $method = 'POST';

        $options = ['headers' => [
            'SOAPAction' => '',
        ]];

//        var_dump(file_get_contents($certFileName));

        if ($useCert) {
            $options['cert'] = [$certFileName, $password];
        }

        // TODO: We should get verification working
        // https://docs.guzzlephp.org/en/stable/request-options.html#verify-option
        $options['verify'] = false;
//        $options['verify'] = './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.crt.pem';
//        $options['verify'] = './vendor/dbp/relay-dispatch-bundle/_.vendo.pem';
//        $options['verify'] = './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.pem';

        $options['body'] = $body;

        try {
            $response = $client->request($method, $uri, $options);
        } catch (RequestException $e) {
            // Error 500 go here
//            var_dump($e->getRequest());
            var_dump($e->getMessage());
            // TODO: Handle errors
            $response = $e->getResponse();
        }

        return $response;
    }

    /**
     * See: https://cloud.tugraz.at/index.php/f/102577184.
     */
    public function generateRequestAPIXML(Request $request): string
    {
        $xml = new \DOMDocument('1.0', 'UTF-8');
        $xml_soapenvEnvelope = $xml->createElement('soapenv:Envelope');
        $xml_soapenvEnvelope->setAttribute('xmlns:soapenv', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml_soapenvEnvelope->setAttribute('xmlns:ns', 'http://reference.e-government.gv.at/namespace/zustellung/dual/20130121#');
        $xml_soapenvEnvelope->setAttribute('xmlns:ns1', 'http://reference.e-government.gv.at/namespace/persondata/20130121#');

        $xml_soapenvHeader = $xml->createElement('soapenv:Header');
        $xml_soapenvEnvelope->appendChild($xml_soapenvHeader);

        $xml_soapenvBody = $xml->createElement('soapenv:Body');
        $xml_nsDualDeliveryRequest = $xml->createElement('ns:DualDeliveryRequest');
        $xml_nsDualDeliveryRequest->setAttribute('version', '1.0');
        $xml_nsSender = $xml->createElement('ns:Sender');
        $xml_nsSenderProfile = $xml->createElement('ns:SenderProfile', $this->senderProfile);
        $xml_nsSenderProfile->setAttribute('version', '1.0');
        $xml_nsSender->appendChild($xml_nsSenderProfile);
        $xml_nsDualDeliveryRequest->appendChild($xml_nsSender);
//        $xml_nsDualDeliveryID = $xml->createElement('ns:DualDeliveryID', '87720');
//        $xml_nsDualDeliveryRequest->appendChild($xml_nsDualDeliveryID);
        $xml_nsMetaData = $xml->createElement('ns:MetaData');
        $xml_nsAppDeliveryID = $xml->createElement('ns:AppDeliveryID', $request->getIdentifier());
        $xml_nsMetaData->appendChild($xml_nsAppDeliveryID);
        // TODO: Is this always "Rsa"?
        $xml_nsDeliveryQuality = $xml->createElement('ns:DeliveryQuality', 'Rsa');
        $xml_nsMetaData->appendChild($xml_nsDeliveryQuality);
        $xml_nsAsynchronous = $xml->createElement('ns:Asynchronous', 'false');
        $xml_nsMetaData->appendChild($xml_nsAsynchronous);
        // TODO: Do we need a subject?
        $xml_nsSubject = $xml->createElement('ns:Subject', 'Duale Zustellung');
        $xml_nsMetaData->appendChild($xml_nsSubject);
        $xml_nsAdditionalMetaData = $xml->createElement('ns:AdditionalMetaData');
        $xml_nsPropertyValueMetaDataSet = $xml->createElement('ns:PropertyValueMetaDataSet');
        $xml_nsParameter = $xml->createElement('ns:Parameter');
        $xml_nsProperty = $xml->createElement('ns:Property', 'TAGS');
        $xml_nsParameter->appendChild($xml_nsProperty);
        $xml_nsValue = $xml->createElement('ns:Value', 'Schriftstueck');
        $xml_nsParameter->appendChild($xml_nsValue);
        $xml_nsPropertyValueMetaDataSet->appendChild($xml_nsParameter);
        $xml_nsAdditionalMetaData->appendChild($xml_nsPropertyValueMetaDataSet);
        $xml_nsMetaData->appendChild($xml_nsAdditionalMetaData);
        // will be printed, doesn't need to be unique
        $xml_nsGZ = $xml->createElement('ns:GZ', $request->getIdentifier());
        $xml_nsMetaData->appendChild($xml_nsGZ);
        $xml_nsDualDeliveryRequest->appendChild($xml_nsMetaData);
        $xml_nsDeliveryChannels = $xml->createElement('ns:DeliveryChannels');
        $xml_nsDualDeliveryRequest->appendChild($xml_nsDeliveryChannels);

        /** @var RequestRecipient[] $recipients */
        $recipients = $request->getRecipients();
        foreach ($recipients as $recipient) {
            $xml_nsRecipient = $xml->createElement('ns:Recipient');
            $xml_nsRecipientData = $xml->createElement('ns:RecipientData');
            // TODO: Which fields should be submitted? Do we always have a PreAddressingRequest?
            // There is no "RecipientId", says the API
//            $xml_nsRecipientId = $xml->createElement('ns:RecipientId', $recipient->getRecipientId());
//            $xml_nsRecipientId = $xml->createElement('ns:RecipientId', $recipient->getIdentifier());
//            $xml_nsRecipientData->appendChild($xml_nsRecipientId);
//            $xml_nsRecipient->appendChild($xml_nsRecipientData);
            $xml_nsDualDeliveryRequest->appendChild($xml_nsRecipient);
        }

        /** @var RequestFile[] $files */
        $files = $request->getFiles();
        foreach ($files as $file) {
            $xml_nsPayload = $xml->createElement('ns:Payload');
            $xml_nsPayloadAttributes = $xml->createElement('ns:PayloadAttributes');
            $xml_nsFileName = $xml->createElement('ns:FileName', $file->getName());
            $xml_nsPayloadAttributes->appendChild($xml_nsFileName);
            $xml_nsMIMEType = $xml->createElement('ns:MIMEType', $file->getFileFormat());
            $xml_nsPayloadAttributes->appendChild($xml_nsMIMEType);
            $xml_nsPayload->appendChild($xml_nsPayloadAttributes);
            $xml_nsBinaryDocument = $xml->createElement('ns:BinaryDocument');
            $content = base64_encode(stream_get_contents($file->getData()));
            // TODO: remove debug limit
//            $content = substr($content, 0, 100);
            $xml_nsContent = $xml->createElement('ns:Content', $content);
            $xml_nsBinaryDocument->appendChild($xml_nsContent);
            $xml_nsPayload->appendChild($xml_nsBinaryDocument);
            $xml_nsDualDeliveryRequest->appendChild($xml_nsPayload);
        }

        $xml_soapenvBody->appendChild($xml_nsDualDeliveryRequest);
        $xml_soapenvEnvelope->appendChild($xml_soapenvBody);
        $xml->appendChild($xml_soapenvEnvelope);

        return $xml->saveXML();
    }
}
