<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Traits;

use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\DispatchBundle\Entity\Request;
use Dbp\Relay\DispatchBundle\Entity\RequestFile;
use Dbp\Relay\DispatchBundle\Entity\RequestRecipient;
use Dbp\Relay\DispatchBundle\Helpers\Tools;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\Response;

trait DOMMethodsTrait
{
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

        // _TODO: We should get verification working
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
            // _TODO: Handle errors
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
//        // _TODO: We should get verification working
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
//            // _TODO: Handle errors
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
        // _TODO: Is this always "Rsa"?
        $xml_nsDeliveryQuality = $xml->createElement('ns:DeliveryQuality', 'Rsa');
        $xml_nsMetaData->appendChild($xml_nsDeliveryQuality);
        $xml_nsAsynchronous = $xml->createElement('ns:Asynchronous', 'true');
        $xml_nsMetaData->appendChild($xml_nsAsynchronous);
        // _TODO: Do we need a subject?
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
            // _TODO: We need a DateOfBirth
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

            // _TODO: Which fields should be submitted? Do we always have a PreAddressingRequest?
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
            // _TODO: remove debug limit
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
}
