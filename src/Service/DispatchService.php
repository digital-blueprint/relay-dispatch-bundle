<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Service;

use DateTimeZone;
use Dbp\Relay\BasePersonBundle\API\PersonProviderInterface;
use Dbp\Relay\BasePersonBundle\Entity\Person;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ApplicationID;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\BinaryDocumentType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Checksum;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DeliveryAddress;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DeliveryChannels;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DeliveryChannelSetType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\MetaData as DualDeliveryMetadata;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPre\MetaData as PreMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressingRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ErrorType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ParametersType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ParameterType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PayloadAttributesType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PayloadType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PersonDataType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PersonNameType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PhysicalPersonType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PostalAddressType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ProcessingProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Recipient;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Recipients;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\RecipientType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SenderType;
use Dbp\Relay\DispatchBundle\Entity\DeliveryStatusChange;
use Dbp\Relay\DispatchBundle\Entity\PreAddressingRequest;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Helpers\Tools;
use Dbp\Relay\DispatchBundle\Message\RequestSubmissionMessage;
//use Dbp\Relay\DispatchBundle\SoapClient\ApplicationID;
//use Dbp\Relay\DispatchBundle\SoapClient\DDPollingWebService10_2Service;
//use Dbp\Relay\DispatchBundle\SoapClient\StatusRequestType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use GuzzleHttp\Exception\RequestException;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\UnrecoverableMessageHandlingException;
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
     * Fetches a DeliveryStatusChange for the current person.
     */
    public function getDeliveryStatusChangeByIdForCurrentPerson(string $identifier): ?DeliveryStatusChange
    {
        $deliveryStatusChange = $this->getDeliveryStatusChangeById($identifier);

        // Check if current person owns the request of the recipient
        $this->getRequestRecipientByIdForCurrentPerson($deliveryStatusChange->getDispatchRequestRecipientIdentifier());

        return $deliveryStatusChange;
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

    public function createRequestFile(UploadedFile $uploadedFile, string $dispatchRequestIdentifier): RequestFile
    {
        $data = $uploadedFile->getContent();
        $requestFile = new RequestFile();

        // A request object needs to be set for the ORM, setting the identifier only will not persist it
        $requestFile->setDispatchRequestIdentifier($dispatchRequestIdentifier);
        $request = $this->getRequestById($requestFile->getDispatchRequestIdentifier());
        $requestFile->setRequest($request);

        $requestFile->setIdentifier((string) Uuid::v4());
        $requestFile->setName($uploadedFile->getClientOriginalName());
        $requestFile->setData($data);
        $requestFile->setFileFormat($uploadedFile->getClientMimeType());
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

    public function createDeliveryStatusChange(string $requestRecipientIdentifier, int $statusType, string $description): DeliveryStatusChange
    {
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
        $this->updateRequestForCurrentPerson($request);

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

    public function handleRequestSubmissionMessage(RequestSubmissionMessage $message)
    {
        $request = $message->getRequest();
        dump($request);

        try {
            // Do Vendo API request
            $this->doDualDeliveryRequestSoapRequest($request);
        } catch (\Throwable $e) {
            // TODO: how do we handle when request didn't get through?
            throw new UnrecoverableMessageHandlingException('Request could not be submitted to Vendo!', 0, $e);
        }

        // TODO: Dispatch another delayed message if Vendo request failed (is this even possible now since DualDeliveryRequests are made for each recipient?)
        $this->createDeliveryStatusChangeForAllRecipientsOfRequest($request, DeliveryStatusChange::STATUS_IN_PROGRESS, 'Request transferred to Vendo');
    }

    public function doDualDeliveryRequestAPIRequest($body): ?\Psr\Http\Message\ResponseInterface
    {
        $uri = $this->deliveryRequestUrl;

        return $this->doAPIRequest($uri, $body);
    }

    public function doPreAddressingAPIRequest($body): ?\Psr\Http\Message\ResponseInterface
    {
        $uri = $this->preAddressingRequestUrl;

        return $this->doAPIRequest($uri, $body);
    }

    public function doStatusRequestAPIRequest($body): ?\Psr\Http\Message\ResponseInterface
    {
        $uri = $this->statusRequestUrl;

        return $this->doAPIRequest($uri, $body);
    }

    protected function doAPIRequest($uri, $body): ?\Psr\Http\Message\ResponseInterface
    {
        $client = new \GuzzleHttp\Client();
        $password = $this->certPassword;
        $useCert = $this->certPassword !== '' && $this->cert !== '';
        $certFileName = '';
//        $certFileName = './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.clcerts.pem';
//        $certFileName = './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.crt.pem';
//        $certFileName = './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.p12';

        if ($useCert) {
            // It's essential to use a file name with a .pem extension, otherwise the certificate will not be recognized by Guzzle
            $certFileName = Tools::getTempFileName('.pem');

            $byteWritten = file_put_contents($certFileName, $this->cert);

            if ($byteWritten === false) {
                throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'Cert data could not be written to file!', 'dispatch:write-cert-error');
            }
        }

//        $uri = 'https://dualtest.vendo.at/mprs-core/services10/DDWebServiceProcessor';
//        $uri = 'https://www.howsmyssl.com/a/check';
//        $uri = $this->deliveryRequestUrl;
        $method = 'POST';

        $options = [
//            'proxy' => "socks5://localhost:32222",
            'headers' => [
                'Content-Type' => 'text/xml;charset=UTF-8',
                'SOAPAction' => '',
            ],
            'curl' => [
                CURLOPT_SSLVERSION => CURL_SSLVERSION_MAX_TLSv1_2,
//                CURLOPT_SSL_VERIFYHOST => false,
//                CURLOPT_SSL_VERIFYPEER => false,
//                CURLOPT_SSLCERT => $certFileName,
//                CURLOPT_SSLCERT => './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.crt.pem',
//                CURLOPT_SSLCERTPASSWD => $password,
//                CURLOPT_SSLKEY => './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.key.pem',
            ],
        ];

        if ($useCert) {
            $options['cert'] = [$certFileName, $password];
        }

        // TODO: We should get verification working
        // https://docs.guzzlephp.org/en/stable/request-options.html#verify-option
        $options['verify'] = false;
//        $options['verify'] = './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.crt.pem';
//        $options['verify'] = './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.pem';
//        var_dump($options);

//        $body = file_get_contents('./vendor/dbp/relay-dispatch-bundle/examples/DualDeliveryRequest.xml');
        $options['body'] = $body;

        try {
            $response = $client->request($method, $uri, $options);
        } catch (RequestException $e) {
            // Error 500 go here
//            var_dump($e->getRequest());
            var_dump($e->getMessage());
            // TODO: Handle errors
            $response = $e->getResponse();
        } finally {
            if ($useCert) {
                unlink($certFileName);
            }
        }

        return $response;
    }

//    protected function doSoapAPIRequest($uri, $body): ?\Psr\Http\Message\ResponseInterface
//    {
//        $client = new \GuzzleHttp\Client();
//        $password = $this->certPassword;
//        $useCert = $this->certPassword !== '' && $this->cert !== '';
//        $certFileName = '';
    ////        $certFileName = './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.clcerts.pem';
    ////        $certFileName = './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.crt.pem';
    ////        $certFileName = './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.p12';
//
//        if ($useCert) {
//            // It's essential to use a file name with a .pem extension, otherwise the certificate will not be recognized by Guzzle
//            $certFileName = Tools::getTempFileName('pem');
//
//            $byteWritten = file_put_contents($certFileName, $this->cert);
//
//            if ($byteWritten === false) {
//                throw ApiError::withDetails(Response::HTTP_INTERNAL_SERVER_ERROR, 'Cert data could not be written to file!', 'dispatch:write-cert-error');
//            }
//        }
//
    ////        $uri = 'https://dualtest.vendo.at/mprs-core/services10/DDWebServiceProcessor';
    ////        $uri = 'https://www.howsmyssl.com/a/check';
    ////        $uri = $this->deliveryRequestUrl;
//        $method = 'POST';
//
//        $options = [
    ////            'proxy' => "socks5://localhost:32222",
//            'headers' => [
//                'Content-Type' => 'text/xml;charset=UTF-8',
//                'SOAPAction' => '',
//            ],
//            'curl' => [
//                CURLOPT_SSLVERSION => CURL_SSLVERSION_MAX_TLSv1_2,
    ////                CURLOPT_SSL_VERIFYHOST => false,
    ////                CURLOPT_SSL_VERIFYPEER => false,
    ////                CURLOPT_SSLCERT => $certFileName,
    ////                CURLOPT_SSLCERT => './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.crt.pem',
    ////                CURLOPT_SSLCERTPASSWD => $password,
    ////                CURLOPT_SSLKEY => './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.key.pem',
//            ],
//        ];
//
//        if ($useCert) {
//            $options['cert'] = [$certFileName, $password];
//        }
//
//        // TODO: We should get verification working
//        // https://docs.guzzlephp.org/en/stable/request-options.html#verify-option
//        $options['verify'] = false;
    ////        $options['verify'] = './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.crt.pem';
    ////        $options['verify'] = './vendor/dbp/relay-dispatch-bundle/tu_graz_client.kbprintcom.at_.pem';
    ////        var_dump($options);
//
    ////        $body = file_get_contents('./vendor/dbp/relay-dispatch-bundle/examples/DualDeliveryRequest.xml');
//        $options['body'] = $body;
//
//        try {
    ////            $response = $client->request($method, $uri, $options);
//
//            $options = array(
//                'uri' => $uri,
    ////                'uri' => 'https://dualtest.vendo.at',
    ////                'location'      => $uri,
//                'location'      => 'https://dualtest.vendo.at/mprs-polling/services10/DDPollingServiceProcessor',
//                'ssl_method'    => SOAP_SSL_METHOD_SSLv2,
//                'local_cert'    => $certFileName,
//                'passphrase'    => $password,
//                'cache_wsdl'    => WSDL_CACHE_NONE,
//                "context" => stream_context_create(
//                    array(
//                        "ssl"=>array(
//                            "verify_peer"=>false
//                        )
//                    )
//                )
//            );
//
//            var_dump($options);
//
//            $service = new DDPollingWebService10_2Service($options);
//            $applicationId = new ApplicationID('1234567890', '1');
//            $statusRequestType = new StatusRequestType($applicationId, '1234567890', 1231123);
//            var_dump($statusRequestType);
    ////            /** @var DualNotificationRequestType $response */
//            $response = $service->poll($statusRequestType);
//            var_dump($service);
//
//            var_dump($response);
//        } catch (RequestException $e) {
//            // Error 500 go here
    ////            var_dump($e->getRequest());
//            var_dump($e->getMessage());
//            // TODO: Handle errors
//            $response = $e->getResponse();
//        } finally {
//            if ($useCert) {
//                unlink($certFileName);
//            }
//        }
//
//        return $response;
//    }

    /**
     * See: https://cloud.tugraz.at/index.php/f/102577184.
     */
    public function generateRequestAPIXML(Request $request): string
    {
        $xml = new \DOMDocument('1.0', 'UTF-8');
        $xml_soapenvEnvelope = $xml->createElement('soapenv:Envelope');
        $xml_soapenvEnvelope->setAttribute('xmlns:soapenv', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml_soapenvEnvelope->setAttribute('xmlns:ns', 'http://reference.e-government.gv.at/namespace/zustellung/dual/20130121#');
        $xml_soapenvEnvelope->setAttribute('xmlns:ns2', 'http://reference.e-government.gv.at/namespace/persondata/20130121#');

        $xml_soapenvHeader = $xml->createElement('soapenv:Header');
        $xml_soapenvEnvelope->appendChild($xml_soapenvHeader);

        $xml_soapenvBody = $xml->createElement('soapenv:Body');
        $xml_nsDualDeliveryRequest = $xml->createElement('ns:DualDeliveryRequest');
        $xml_nsDualDeliveryRequest->setAttribute('version', '1.0');
        $xml_nsSender = $xml->createElement('ns:Sender');
        $xml_nsSenderProfile = $xml->createElement('ns:SenderProfile', $this->dd->getSenderProfile()->get_());
        $xml_nsSenderProfile->setAttribute('version', $this->dd->getSenderProfile()->getVersion());
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
        $xml_nsAsynchronous = $xml->createElement('ns:Asynchronous', 'true');
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
//            $xml_nsRecipientData = $xml->createElement('ns:RecipientData');
            $xml_RecipientData = $xml->createElement('ns:RecipientData');
            $xml_ns2PhysicalPerson = $xml->createElement('ns2:PhysicalPerson');
            $xml_ns2Name = $xml->createElement('ns2:Name');
            $xml_ns2GivenName = $xml->createElement('ns2:GivenName', $recipient->getGivenName());
            $xml_ns2Name->appendChild($xml_ns2GivenName);
            $xml_ns2FamilyName = $xml->createElement('ns2:FamilyName', $recipient->getFamilyName());
            $xml_ns2Name->appendChild($xml_ns2FamilyName);
            $xml_ns2PhysicalPerson->appendChild($xml_ns2Name);
            // TODO: We need a DateOfBirth
//            $xml_ns2DateOfBirth = $xml->createElement('ns2:DateOfBirth','1970-06-04');
//            $xml_ns2PhysicalPerson->appendChild($xml_ns2DateOfBirth);
            $xml_RecipientData->appendChild($xml_ns2PhysicalPerson);
            $xml_ns2PostalAddress = $xml->createElement('ns2:PostalAddress');
            $xml_ns2CountryCode = $xml->createElement('ns2:CountryCode', $recipient->getAddressCountry());
            $xml_ns2PostalAddress->appendChild($xml_ns2CountryCode);
            $xml_ns2PostalCode = $xml->createElement('ns2:PostalCode', $recipient->getPostalCode());
            $xml_ns2PostalAddress->appendChild($xml_ns2PostalCode);
            $xml_ns2Municipality = $xml->createElement('ns2:Municipality', $recipient->getAddressLocality());
            $xml_ns2PostalAddress->appendChild($xml_ns2Municipality);
            $xml_ns2DeliveryAddress = $xml->createElement('ns2:DeliveryAddress');
            $xml_ns2StreetName = $xml->createElement('ns2:StreetName', $recipient->getStreetAddress());
            $xml_ns2DeliveryAddress->appendChild($xml_ns2StreetName);
            $xml_ns2BuildingNumber = $xml->createElement('ns2:BuildingNumber', $recipient->getBuildingNumber());
            $xml_ns2DeliveryAddress->appendChild($xml_ns2BuildingNumber);
            $xml_ns2PostalAddress->appendChild($xml_ns2DeliveryAddress);
            $xml_RecipientData->appendChild($xml_ns2PostalAddress);
            $xml_nsRecipient->appendChild($xml_RecipientData);

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

    /**
     * See: https://cloud.tugraz.at/index.php/f/102577198.
     */
    public function generatePreAddressingAPIXML(RequestRecipient $requestRecipient): string
    {
        $xml = new \DOMDocument('1.0', 'UTF-8');
        $xml_soapenvEnvelope = $xml->createElement('soapenv:Envelope');

        $xml_soapenvEnvelope->setAttribute('xmlns:soapenv', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml_soapenvEnvelope->setAttribute('xmlns:ns1', 'http://reference.e-government.gv.at/namespace/zustellung/dual_pa/20130121#');
        $xml_soapenvEnvelope->setAttribute('xmlns:ns2', 'http://reference.e-government.gv.at/namespace/zustellung/dual/20130121#');
        $xml_soapenvEnvelope->setAttribute('xmlns:ns3', 'http://reference.e-government.gv.at/namespace/persondata/20130121#');
        $xml_soapenvEnvelope->setAttribute('xmlns:ns4', 'http://reference.postserver.at/namespace/persondata/20170308#');

        $xml_soapenvHeader = $xml->createElement('soapenv:Header');
        $xml_soapenvEnvelope->appendChild($xml_soapenvHeader);
        $xml_soapenvBody = $xml->createElement('soapenv:Body');
        $xml_ns1DualDeliveryPreAddressingRequest = $xml->createElement('ns1:DualDeliveryPreAddressingRequest');
        $xml_ns1DualDeliveryPreAddressingRequest->setAttribute('version', '1.0');
        $xml_ns2Sender = $xml->createElement('ns2:Sender');
        $xml_ns2SenderProfile = $xml->createElement('ns2:SenderProfile', $this->dd->getSenderProfile()->get_());
        $xml_ns2SenderProfile->setAttribute('version', $this->dd->getSenderProfile()->getVersion());
        $xml_ns2Sender->appendChild($xml_ns2SenderProfile);
        $xml_ns1DualDeliveryPreAddressingRequest->appendChild($xml_ns2Sender);
        $xml_ns1Recipients = $xml->createElement('ns1:Recipients');
        $xml_ns1Recipient = $xml->createElement('ns1:Recipient');
//        $xml_ns2RecipientID = $xml->createElement('ns2:RecipientID','A7BDB73B-B310-409A-AB6C-2B45F6818140');
//        $xml_ns1Recipient->appendChild($xml_ns2RecipientID);
        $xml_ns2Recipient = $xml->createElement('ns2:Recipient');
        $xml_ns2RecipientData = $xml->createElement('ns2:RecipientData');
        $xml_ns3PhysicalPerson = $xml->createElement('ns3:PhysicalPerson');
        $xml_ns3Name = $xml->createElement('ns3:Name');
        $xml_ns3GivenName = $xml->createElement('ns3:GivenName', 'Max');
        $xml_ns3Name->appendChild($xml_ns3GivenName);
        $xml_ns3FamilyName = $xml->createElement('ns3:FamilyName', 'Mustermann');
        $xml_ns3Name->appendChild($xml_ns3FamilyName);
        $xml_ns3PhysicalPerson->appendChild($xml_ns3Name);
        $xml_ns3DateOfBirth = $xml->createElement('ns3:DateOfBirth', '1970-06-04');
        $xml_ns3PhysicalPerson->appendChild($xml_ns3DateOfBirth);
        $xml_ns2RecipientData->appendChild($xml_ns3PhysicalPerson);
        $xml_ns2Recipient->appendChild($xml_ns2RecipientData);
        $xml_ns1Recipient->appendChild($xml_ns2Recipient);
        $xml_ns1Recipients->appendChild($xml_ns1Recipient);
        $xml_ns1DualDeliveryPreAddressingRequest->appendChild($xml_ns1Recipients);

        $xml_ns1MetaData = $xml->createElement('ns1:MetaData');
        $xml_ns2AppDeliveryID = $xml->createElement('ns2:AppDeliveryID', '12399_AE_W_Rsa_1');
        $xml_ns1MetaData->appendChild($xml_ns2AppDeliveryID);
        $xml_ns2AdditionalMetaData = $xml->createElement('ns2:AdditionalMetaData');
        $xml_ns2PropertyValueMetaDataSet = $xml->createElement('ns2:PropertyValueMetaDataSet');
        $xml_ns2Parameter = $xml->createElement('ns2:Parameter');
        $xml_ns2Property = $xml->createElement('ns2:Property', 'CampaignId');
        $xml_ns2Parameter->appendChild($xml_ns2Property);
        $xml_ns2Value = $xml->createElement('ns2:Value', 'DUMMY');
        $xml_ns2Parameter->appendChild($xml_ns2Value);
        $xml_ns2PropertyValueMetaDataSet->appendChild($xml_ns2Parameter);
        $xml_ns2AdditionalMetaData->appendChild($xml_ns2PropertyValueMetaDataSet);
        $xml_ns1MetaData->appendChild($xml_ns2AdditionalMetaData);
        $xml_ns2TestCase = $xml->createElement('ns2:TestCase', 'true');
        $xml_ns1MetaData->appendChild($xml_ns2TestCase);
        $xml_ns2ProcessingProfile = $xml->createElement('ns2:ProcessingProfile', 'ZuseDD');
        $xml_ns2ProcessingProfile->setAttribute('version', '1.1');
        $xml_ns1MetaData->appendChild($xml_ns2ProcessingProfile);
        $xml_ns2Asynchronous = $xml->createElement('ns2:Asynchronous', 'false');
        $xml_ns1MetaData->appendChild($xml_ns2Asynchronous);
        $xml_ns1PreCreateSendings = $xml->createElement('ns1:PreCreateSendings', 'true');
        $xml_ns1MetaData->appendChild($xml_ns1PreCreateSendings);
        $xml_ns1DualDeliveryPreAddressingRequest->appendChild($xml_ns1MetaData);
        $xml_ns2DeliveryChannels = $xml->createElement('ns2:DeliveryChannels');
        $xml_ns1DualDeliveryPreAddressingRequest->appendChild($xml_ns2DeliveryChannels);

        $xml_soapenvBody->appendChild($xml_ns1DualDeliveryPreAddressingRequest);
        $xml_soapenvEnvelope->appendChild($xml_soapenvBody);
        $xml->appendChild($xml_soapenvEnvelope);

        return $xml->saveXML();
    }

    public function generateStatusRequestAPIXML(string $appDeliveryId, string $dualDeliveryId): string
    {
        $xml = new \DOMDocument('1.0', 'UTF-8');
        $xml_soapenvEnvelope = $xml->createElement('soapenv:Envelope');

        $xml_soapenvEnvelope->setAttribute('xmlns:soapenv', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml_soapenvEnvelope->setAttribute('xmlns:ns1', 'http://reference.e-government.gv.at/namespace/zustellung/dual_notification/20130121#');
        $xml_soapenvEnvelope->setAttribute('xmlns:ns2', 'http://reference.e-government.gv.at/namespace/zustellung/dual/20130121#');

        $xml_soapenvHeader = $xml->createElement('soapenv:Header');
        $xml_soapenvEnvelope->appendChild($xml_soapenvHeader);
        $xml_soapenvBody = $xml->createElement('soapenv:Body');
        $xml_ns1StatusRequest = $xml->createElement('ns1:StatusRequest');
//        $xml_ns2ApplicationID = $xml->createElement('ns2:ApplicationID', '?XXX?');
//        $xml_ns1StatusRequest->appendChild($xml_ns2ApplicationID);
        $xml_ns2AppDeliveryID = $xml->createElement('ns2:AppDeliveryID', $appDeliveryId);
        $xml_ns1StatusRequest->appendChild($xml_ns2AppDeliveryID);
        $xml_ns2DualDeliveryID = $xml->createElement('ns2:DualDeliveryID', $dualDeliveryId);
        $xml_ns1StatusRequest->appendChild($xml_ns2DualDeliveryID);
        $xml_soapenvBody->appendChild($xml_ns1StatusRequest);
        $xml_soapenvEnvelope->appendChild($xml_soapenvBody);
        $xml->appendChild($xml_soapenvEnvelope);

        return $xml->saveXML();
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
        }

//        dump('$files2');
//        dump($files);
        foreach ($files as $file) {
            $payloadAttrs = new PayloadAttributesType($file->getName(), $file->getFileFormat());
            // TODO: Is this the correct format to send content?
            // $content is base64 encoded by the SOAP library!
            $content = $file->getData();
            $payloadAttrs->setSize($file->getContentSize());
            // Id must not start with a number (says trial & error, xsd:ID or xs:NCName spec don't tell)!
            $payloadAttrs->setId('file-'.$file->getIdentifier());
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

        // TODO: Allow to set this via config/request?
//        $processingProfile = new ProcessingProfile('ZuseDD', '1.0');
        $processingProfile = new ProcessingProfile('ZusePrintHybridDD', '1.0');
        // TODO: Allow to set this via config/request?
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

            $address = new PostalAddressType(
                null,
                $recipient->getPostalCode(),
                $recipient->getAddressLocality(),
                null,
                new DeliveryAddress($recipient->getStreetAddress(), $recipient->getBuildingNumber())
            );
            $address->setCountryCode($recipient->getAddressCountry());

            $personData = new PersonDataType($physicalPerson, $address);
            $dualDeliveryRecipient = new RecipientType($personData);

//            $id = $dualDeliveryRequest->getIdentifier().'-'.$recipient->getIdentifier().'-pbek-'.rand(100000, 999999);
            $id = $dispatchRequest->getIdentifier().'-'.$recipient->getIdentifier();
            $meta = new DualDeliveryMetaData(
                $id,
                null,
                $deliveryQuality,
                'Zustellung '.$id,
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
            dump($request);

            try {
                $response = $service->dualDeliveryRequestOperation($request);
            } catch (\Exception $e) {
                $this->createDeliveryStatusChange($recipient->getIdentifier(),
                    DeliveryStatusChange::STATUS_SOAP_ERROR, 'Soap error: '.$e->getMessage());

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

            dump($response);
            dump($service->getPrettyLastRequest());
            dump($service->getPrettyLastResponse());

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
            $recipient->setDualDeliveryID($response->getDualDeliveryID());

            try {
                $this->em->persist($recipient);
                $this->em->flush();
            } catch (\Exception $e) {
                throw ApiError::withDetails(
                    Response::HTTP_INTERNAL_SERVER_ERROR, 'RequestRecipient could not be update after DualDelivery request!',
                    'dispatch:request-recipient-not-updated', [
                        'request-id' => $dispatchRequest->getIdentifier(),
                        'recipient-id' => $recipient->getIdentifier(),
                        'message' => $e->getMessage(),
                    ]
                );
            }
        }

        return true;
    }
}
