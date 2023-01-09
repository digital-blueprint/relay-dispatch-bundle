<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests\DualDeliveryApi;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ProcessingProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\RecipientType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\SenderProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\SenderType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\FamilyName;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PersonDataType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PersonNameType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PhysicalPersonType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\DualDeliveryPreAddressingRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\DualDeliveryPreAddressingResponseType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\MetaData as PreMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\Recipient;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing\Recipients;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Vendo\ProcessingProfile as VendoProcessingProfile;
use PHPUnit\Framework\TestCase;

class PreAddrTest extends TestCase
{
    use BaseSoapTrait;

    private static $SUCCESS_RESPONSE = '<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <ns4:DualDeliveryPreAddressingResponse xmlns="http://reference.e-government.gv.at/namespace/zustellung/dual/20130121#" xmlns:ns2="http://reference.e-government.gv.at/namespace/persondata/20130121#" xmlns:ns3="http://reference.postserver.at/namespace/persondata/20170308#" xmlns:ns4="http://reference.e-government.gv.at/namespace/zustellung/dual_pa/20130121#" xmlns:ns5="uri:general.additional.params/20130121#" xmlns:ns6="http://www.w3.org/2000/09/xmldsig#" xmlns:ns7="http://www.ebinterface.at/schema/4p0/" xmlns:ns8="http://www.ebinterface.at/schema/4p0/extensions/sv" xmlns:ns9="http://www.ebinterface.at/schema/4p0/extensions/ext" xmlns:ns10="http://reference.e-government.gv.at/namespace/zustellung/dual_notification/20130121#" xmlns:ns11="http://reference.e-government.gv.at/namespace/zustellung/dual_bulk/20130121#" xmlns:ns12="http://reference.e-government.gv.at/namespace/zustellung/msg" xmlns:ns13="http://reference.e-government.gv.at/namespace/persondata/20020228#" xmlns:ns14="urn:oasis:names:tc:SAML:1.0:assertion" xmlns:ns15="http://www.e-zustellung.at/namespaces/zuse_20090922" version="1.0">
      <AppDeliveryID>636ba1dfd012c</AppDeliveryID>
      <Status>
        <Code>0</Code>
        <Text>SUCCESS</Text>
      </Status>
      <DualDeliveryID>132197</DualDeliveryID>
      <ns4:AddressingResults/>
    </ns4:DualDeliveryPreAddressingResponse>
  </soap:Body>
</soap:Envelope>';

    private static $SUCCESS_RESPONSE_RESULT = '<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <ns4:DualDeliveryPreAddressingResponse xmlns="http://reference.e-government.gv.at/namespace/zustellung/dual/20130121#" xmlns:ns2="http://reference.e-government.gv.at/namespace/persondata/20130121#" xmlns:ns3="http://reference.postserver.at/namespace/persondata/20170308#" xmlns:ns4="http://reference.e-government.gv.at/namespace/zustellung/dual_pa/20130121#" xmlns:ns5="uri:general.additional.params/20130121#" xmlns:ns6="http://www.w3.org/2000/09/xmldsig#" xmlns:ns7="http://www.ebinterface.at/schema/4p0/" xmlns:ns8="http://www.ebinterface.at/schema/4p0/extensions/sv" xmlns:ns9="http://www.ebinterface.at/schema/4p0/extensions/ext" xmlns:ns10="http://www.e-zustellung.at/namespaces/zuse_20090922" xmlns:ns11="http://reference.e-government.gv.at/namespace/zustellung/msg" xmlns:ns12="http://reference.e-government.gv.at/namespace/persondata/20020228#" xmlns:ns13="urn:oasis:names:tc:SAML:1.0:assertion" xmlns:ns14="http://reference.e-government.gv.at/namespace/zustellung/dual_bulk/20130121#" xmlns:ns15="http://reference.e-government.gv.at/namespace/zustellung/dual_notification/20130121#" version="1.0">
      <AppDeliveryID>636bbfb63e8a4</AppDeliveryID>
      <Status>
        <Code>0</Code>
        <Text>SUCCESS</Text>
      </Status>
      <DualDeliveryID>132268</DualDeliveryID>
      <ns4:AddressingResults>
        <ns4:AddressingResult>
          <ns4:DeliveryChannelAddressingResult>
            <Name>TNVZAddressing_1.0</Name>
            <Status>
              <Code>4</Code>
              <Text>ADDRESSABLE</Text>
            </Status>
          </ns4:DeliveryChannelAddressingResult>
          <DualDeliveryID>132269</DualDeliveryID>
          <RecipientID>4444</RecipientID>
        </ns4:AddressingResult>
      </ns4:AddressingResults>
    </ns4:DualDeliveryPreAddressingResponse>
  </soap:Body>
</soap:Envelope>';

    public function testPreAddressingRequestOperationNoResults()
    {
        $service = $this->getMockService(self::$SUCCESS_RESPONSE);

        $senderProfile = new SenderProfile('TU_GRAZ', '1.0');
        $sender = new SenderType($senderProfile);
        $physicalPerson = new PhysicalPersonType(new PersonNameType('Max', new FamilyName('Mustermann')), '1970-06-04');
        $personData = new PersonDataType($physicalPerson);
        $recipient = new RecipientType($personData);
        $recipients = new Recipients([new Recipient('424242', $recipient)]);
        $meta = new PreMetaData('636ba1dfd012c');
        $meta->setProcessingProfile(new ProcessingProfile(VendoProcessingProfile::ZUSE_DD, VendoProcessingProfile::VERSION_PRE_ADDRESSING));
        $meta->setAsynchronous(false);
        $request = new DualDeliveryPreAddressingRequestType($sender, $recipients, $meta, null, '1.0');
        $response = $service->dualDeliveryPreAddressingRequestOperation($request);

        // check request
        $lastRequest = $service->__getLastRequest();
        $this->assertStringContainsString('Max', $lastRequest);
        $this->assertStringContainsString('Mustermann', $lastRequest);
        $this->assertStringContainsString('1970-06-04', $lastRequest);
        $this->assertStringContainsString('424242', $lastRequest);
        $this->assertStringContainsString(VendoProcessingProfile::ZUSE_DD, $lastRequest);
        $this->assertStringContainsString(VendoProcessingProfile::VERSION_PRE_ADDRESSING, $lastRequest);

        // check response
        $this->assertTrue($response instanceof DualDeliveryPreAddressingResponseType);
        $this->assertSame('132197', $response->getDualDeliveryID());
        $this->assertSame('636ba1dfd012c', $response->getAppDeliveryID());
        $this->assertSame('0', $response->getStatus()->getCode());
        $this->assertSame('SUCCESS', $response->getStatus()->getText());
        $this->assertEmpty($response->getAddressingResults()->getAddressingResult());
    }

    public function testPreAddressingRequestOperationWithResults()
    {
        $service = $this->getMockService(self::$SUCCESS_RESPONSE_RESULT);

        $senderProfile = new SenderProfile('TU_GRAZ', '1.0');
        $sender = new SenderType($senderProfile);
        $physicalPerson = new PhysicalPersonType(new PersonNameType('Manuel', new FamilyName('Mustermann')), '1970-06-04');
        $personData = new PersonDataType($physicalPerson);
        $recipient = new RecipientType($personData);
        $recipients = new Recipients([new Recipient('4444', $recipient)]);
        $meta = new PreMetaData('636bbfb63e8a4');
        $meta->setProcessingProfile(new ProcessingProfile(VendoProcessingProfile::ZUSE_DD, VendoProcessingProfile::VERSION_PRE_ADDRESSING));
        $meta->setAsynchronous(false);
        $request = new DualDeliveryPreAddressingRequestType($sender, $recipients, $meta, null, '1.0');
        $response = $service->dualDeliveryPreAddressingRequestOperation($request);

        // check request
        $lastRequest = $service->__getLastRequest();
        $this->assertStringContainsString('Manuel', $lastRequest);
        $this->assertStringContainsString('Mustermann', $lastRequest);
        $this->assertStringContainsString('1970-06-04', $lastRequest);
        $this->assertStringContainsString('4444', $lastRequest);

        // response
        $this->assertTrue($response instanceof DualDeliveryPreAddressingResponseType);
        $this->assertSame('132268', $response->getDualDeliveryID());
        $this->assertSame('636bbfb63e8a4', $response->getAppDeliveryID());
        $this->assertSame('0', $response->getStatus()->getCode());
        $this->assertSame('SUCCESS', $response->getStatus()->getText());
        $results = $response->getAddressingResults()->getAddressingResult();
        $this->assertCount(1, $results);
        $result = $results[0];

        // result
        $this->assertSame('132269', $result->getDualDeliveryID());
        $this->assertSame('4444', $result->getRecipientID());
        $channelResults = $result->getDeliveryChannelAddressingResult();
        $this->assertCount(1, $channelResults);
        $channelResult = $channelResults[0];

        // channel result
        $this->assertSame('TNVZAddressing_1.0', $channelResult->getName());
        $this->assertSame('4', $channelResult->getStatus()->getCode());
        $this->assertSame('ADDRESSABLE', $channelResult->getStatus()->getText());
    }
}
