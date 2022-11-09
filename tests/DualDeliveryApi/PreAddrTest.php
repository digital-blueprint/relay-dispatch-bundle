<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests\DualDeliveryApi;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\DualDeliveryService;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPre\MetaData as PreMetaData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressingRequestType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressingResponseType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PersonDataType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PersonNameType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\PhysicalPersonType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\ProcessingProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Recipient;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Recipients;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\RecipientType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SenderProfile;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SenderType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Vendo\ProcessingProfile as VendoProcessingProfile;
use PHPUnit\Framework\TestCase;

class PreAddrTest extends TestCase
{
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

    public function testPreAddressingRequestOperationNoResults()
    {
        $service = $this->getMockService(self::$SUCCESS_RESPONSE);

        $senderProfile = new SenderProfile('TU_GRAZ', '1.0');
        $sender = new SenderType($senderProfile);
        $physicalPerson = new PhysicalPersonType(new PersonNameType('Max', 'Mustermann'), '1970-06-04');
        $personData = new PersonDataType($physicalPerson);
        $recipient = new RecipientType($personData);
        $recipients = new Recipients([new Recipient('1', $recipient)]);
        $meta = new PreMetaData('636ba1dfd012c');
        $meta->setProcessingProfile(new ProcessingProfile(VendoProcessingProfile::ZUSE_DD, VendoProcessingProfile::VERSION_PRE_ADDRESSING));
        $meta->setAsynchronous(false);
        $request = new DualDeliveryPreAddressingRequestType($sender, $recipients, $meta, null, '1.0');
        $response = $service->dualDeliveryPreAddressingRequestOperation($request);

        $this->assertTrue($response instanceof DualDeliveryPreAddressingResponseType);
        $this->assertSame('132197', $response->getDualDeliveryID());
        $this->assertSame('636ba1dfd012c', $response->getAppDeliveryID());
        $this->assertSame('0', $response->getStatus()->getCode());
        $this->assertSame('SUCCESS', $response->getStatus()->getText());
        $this->assertEmpty($response->getAddressingResults()->getAddressingResult());
    }
}
