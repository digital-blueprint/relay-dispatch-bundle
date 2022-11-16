<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests\DualDeliveryApi;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\DualDeliveryService;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\StatusRequestType;
use PHPUnit\Framework\TestCase;

class StatusRequestTest extends TestCase
{
    private static $SUCCESS_RESPONSE = '<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <ns2:StatusResponse xmlns="http://reference.e-government.gv.at/namespace/zustellung/dual/20130121#" xmlns:ns2="http://reference.e-government.gv.at/namespace/zustellung/dual_notification/20130121#" xmlns:ns3="uri:general.additional.params/20130121#" xmlns:ns4="http://reference.e-government.gv.at/namespace/persondata/20130121#" xmlns:ns5="http://reference.postserver.at/namespace/persondata/20170308#" xmlns:ns6="http://www.w3.org/2000/09/xmldsig#" xmlns:ns7="http://www.ebinterface.at/schema/4p0/" xmlns:ns8="http://www.ebinterface.at/schema/4p0/extensions/sv" xmlns:ns9="http://www.ebinterface.at/schema/4p0/extensions/ext" xmlns:ns10="http://reference.e-government.gv.at/namespace/zustellung/msg" xmlns:ns11="http://reference.e-government.gv.at/namespace/persondata/20020228#" xmlns:ns12="urn:oasis:names:tc:SAML:1.0:assertion" xmlns:ns13="http://www.e-zustellung.at/namespaces/zuse_20090922" xmlns:ns14="http://reference.e-government.gv.at/namespace/zustellung/dual_ca/20130121#" xmlns:ns15="http://reference.e-government.gv.at/namespace/zustellung/dual_bulk/20130121#" version="1.0">
      <AppDeliveryID>foo-6374de7d5ed47</AppDeliveryID>
      <DualDeliveryID>132478</DualDeliveryID>
      <Status>
        <Code>P3</Code>
        <Text>InDelivery</Text>
      </Status>
    </ns2:StatusResponse>
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

    public function testStatusRequestSuccess()
    {
        $service = $this->getMockService(self::$SUCCESS_RESPONSE);

        $request = new StatusRequestType(null, 'foo-6374de7d5ed47', null);
        $response = $service->dualStatusRequestOperation($request);
        $this->assertSame('foo-6374de7d5ed47', $response->getAppDeliveryID());
        $this->assertSame('132478', $response->getDualDeliveryID());
        $this->assertSame('P3', $response->getStatus()->getCode());
        $this->assertSame('InDelivery', $response->getStatus()->getText());
    }
}
