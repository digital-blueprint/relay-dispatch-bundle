<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests\DualDeliveryApi;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\BinaryDocumentType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\Checksum;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\DualDeliveryRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\MetaData as DualDeliveryMetadata;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\PayloadAttributesType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\PayloadType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ProcessingProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\RecipientType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\SenderData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\SenderProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\SenderType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\CorporateBodyType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\DeliveryAddress;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\FamilyName;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PersonDataType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PersonNameType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PhysicalPersonType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PostalAddressType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Vendo\DeliveryQuality;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    use BaseSoapTrait;

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

    public function testDualDeliveryRequestSuccess()
    {
        $service = $this->getMockService(self::$SUCCESS_RESPONSE);

        $physicalPerson = new PhysicalPersonType(
            new PersonNameType('Max', new FamilyName('Mustermann')), '1970-06-04');

        $address = new PostalAddressType(
            null,
            '8010', 'Graz',
            new DeliveryAddress('Hauptplatz', '2442')
        );
        $address->setCountryCode('AT');

        $personData = new PersonDataType($physicalPerson, $address);
        $dualDeliveryRecipient = new RecipientType($personData);

        $data = file_get_contents(__DIR__.'/example.pdf');
        $payloadAttrs = new PayloadAttributesType('example.pdf', 'application/pdf');
        $payloadAttrs->setId('foobar-63739fd47e012');
        $payloadAttrs->setChecksum(new Checksum('MD5', md5($data)));
        $doc = new BinaryDocumentType($data);
        $dualDeliveryPayloads = [new PayloadType($payloadAttrs, $doc)];

        $senderAddress = new PostalAddressType(
            null,
            '1090', 'Wien',
            new DeliveryAddress('Hauptstrasse', '1234')
        );
        $address->setCountryCode('AT');
        $sender = new CorporateBodyType('Voller Name');
        $sender->setOrganization('Organisation');

        $senderProfile = new SenderProfile('TU_GRAZ', '1.0');
        $senderData = new SenderData($sender, $senderAddress);
        $sender = new SenderType($senderProfile, $senderData);
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

        // check request
        $lastRequest = $service->__getLastRequest();
        $this->assertStringContainsString('Max', $lastRequest);
        $this->assertStringContainsString('Mustermann', $lastRequest);
        $this->assertStringContainsString('1970-06-04', $lastRequest);
        $this->assertStringContainsString('example.pdf', $lastRequest);
        $this->assertStringContainsString('8010', $lastRequest);
        $this->assertStringContainsString('Graz', $lastRequest);
        $this->assertStringContainsString('Hauptplatz', $lastRequest);
        $this->assertStringContainsString('2442', $lastRequest);

        // sender data
        $this->assertStringContainsString('1090', $lastRequest);
        $this->assertStringContainsString('Wien', $lastRequest);
        $this->assertStringContainsString('Hauptstrasse', $lastRequest);
        $this->assertStringContainsString('1234', $lastRequest);
        $this->assertStringContainsString('Voller Name', $lastRequest);
        $this->assertStringContainsString('Organisation', $lastRequest);

        $this->assertSame('foo-6373a0a778ca1', $response->getAppDeliveryID());
        $this->assertSame('132387', $response->getDualDeliveryID());
        $this->assertSame('1.0', $response->getVersion());
        $this->assertSame('0', $response->getStatus()->getCode());
        $this->assertSame('SUCCESS', $response->getStatus()->getText());
    }
}
