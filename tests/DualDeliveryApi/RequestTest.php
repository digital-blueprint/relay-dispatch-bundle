<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests\DualDeliveryApi;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\DualDeliveryService;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\BinaryDocumentType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Checksum;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\MetaData as DualDeliveryMetadata;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PayloadAttributesType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PayloadType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PersonDataType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PersonNameType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PhysicalPersonType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ProcessingProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\RecipientType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SenderProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SenderType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Vendo\DeliveryQuality;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    private static $SUCCESS_RESPONSE = '<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <DualDeliveryResponse xmlns="http://reference.e-government.gv.at/namespace/zustellung/dual/20130121#" xmlns:ns2="http://reference.e-government.gv.at/namespace/persondata/20130121#" xmlns:ns3="http://reference.postserver.at/namespace/persondata/20170308#" xmlns:ns4="http://www.w3.org/2000/09/xmldsig#" xmlns:ns5="http://www.ebinterface.at/schema/4p0/" xmlns:ns6="http://www.ebinterface.at/schema/4p0/extensions/sv" xmlns:ns7="http://www.ebinterface.at/schema/4p0/extensions/ext" xmlns:ns8="uri:general.additional.params/20130121#" xmlns:ns9="http://reference.e-government.gv.at/namespace/zustellung/dual_notification/20130121#" xmlns:ns10="http://reference.e-government.gv.at/namespace/zustellung/msg" xmlns:ns11="http://reference.e-government.gv.at/namespace/persondata/20020228#" xmlns:ns12="urn:oasis:names:tc:SAML:1.0:assertion" xmlns:ns13="http://www.e-zustellung.at/namespaces/zuse_20090922" xmlns:ns14="http://reference.e-government.gv.at/namespace/zustellung/dual_bulk/20130121#" version="1.0">
      <AppDeliveryID>foo-6373a0a778ca1</AppDeliveryID>
      <Status>
        <Code>0</Code>
        <Text>SUCCESS</Text>
      </Status>
      <DualDeliveryID>132387</DualDeliveryID>
    </DualDeliveryResponse>
  </soap:Body>
</soap:Envelope>';

    /**
     * @return DualDeliveryService
     */
    private function getMockService(string $response)
    {
        $soapClientMock = $this->getMockBuilder(DualDeliveryService::class)
            ->setConstructorArgs(['nope'])
            ->onlyMethods(['__doRequest'])
            ->getMock();
        $soapClientMock->method('__doRequest')->will($this->returnValue($response));

        return $soapClientMock;
    }

    public function testDualDeliveryRequestSuccess()
    {
        $service = $this->getMockService(self::$SUCCESS_RESPONSE);

        $physicalPerson = new PhysicalPersonType(
            new PersonNameType('Max', 'Mustermann'), '1970-06-04');
        $personData = new PersonDataType($physicalPerson);
        $dualDeliveryRecipient = new RecipientType($personData);

        $data = file_get_contents(__DIR__.'/example.pdf');
        $payloadAttrs = new PayloadAttributesType('example.pdf', 'application/pdf');
        $payloadAttrs->setId('foobar-63739fd47e012');
        $payloadAttrs->setChecksum(new Checksum('MD5', md5($data)));
        $doc = new BinaryDocumentType($data);
        $dualDeliveryPayloads = [new PayloadType($payloadAttrs, $doc)];

        $senderProfile = new SenderProfile('TU_GRAZ', '1.0');
        $sender = new SenderType($senderProfile);
        $processingProfile = new ProcessingProfile('ZusePrintHybridDD', '1.0');

        $meta = new DualDeliveryMetaData(
            'foo-6373a0a778ca1',
            null,
            DeliveryQuality::RSA,
            'k thx bye',
            'GZ',
            null,
            null,
            false,
            $processingProfile,
            null,
            true
        );

        $request = new DualDeliveryRequest(
            $sender, null, $dualDeliveryRecipient, $meta, null, $dualDeliveryPayloads, '1.0');
        $response = $service->dualDeliveryRequestOperation($request);

        $this->assertSame('foo-6373a0a778ca1', $response->getAppDeliveryID());
        $this->assertSame('132387', $response->getDualDeliveryID());
        $this->assertSame('1.0', $response->getVersion());
        $this->assertSame('0', $response->getStatus()->getCode());
        $this->assertSame('SUCCESS', $response->getStatus()->getText());
    }
}
