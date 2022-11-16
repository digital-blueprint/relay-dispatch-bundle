<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests\DualDeliveryApi;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryCancellationRequest;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SenderProfile;
use PHPUnit\Framework\TestCase;

class CancelRequestTest extends TestCase
{
    use BaseSoapTrait;

    private static $SUCCESS_RESPONSE = '<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <ns14:DualDeliveryCancellationResponse xmlns="http://reference.e-government.gv.at/namespace/zustellung/dual/20130121#" xmlns:ns2="http://reference.e-government.gv.at/namespace/zustellung/dual_notification/20130121#" xmlns:ns3="uri:general.additional.params/20130121#" xmlns:ns4="http://reference.e-government.gv.at/namespace/persondata/20130121#" xmlns:ns5="http://reference.postserver.at/namespace/persondata/20170308#" xmlns:ns6="http://www.w3.org/2000/09/xmldsig#" xmlns:ns7="http://www.ebinterface.at/schema/4p0/" xmlns:ns8="http://www.ebinterface.at/schema/4p0/extensions/sv" xmlns:ns9="http://www.ebinterface.at/schema/4p0/extensions/ext" xmlns:ns10="http://reference.e-government.gv.at/namespace/zustellung/msg" xmlns:ns11="http://reference.e-government.gv.at/namespace/persondata/20020228#" xmlns:ns12="urn:oasis:names:tc:SAML:1.0:assertion" xmlns:ns13="http://www.e-zustellung.at/namespaces/zuse_20090922" xmlns:ns14="http://reference.e-government.gv.at/namespace/zustellung/dual_ca/20130121#" xmlns:ns15="http://reference.e-government.gv.at/namespace/zustellung/dual_bulk/20130121#" version="1.0">
      <DualDeliveryID>132487</DualDeliveryID>
      <Status>
        <Code>39</Code>
        <Text>SenderProfil:&lt;TU_GRAZ&gt;-&lt;1.0&gt; darf MessageProfil:&lt;na_1.0&gt; nicht verwenden.</Text>
      </Status>
    </ns14:DualDeliveryCancellationResponse>
  </soap:Body>
</soap:Envelope>';

    public function testCancelRequestError()
    {
        $service = $this->getMockService(self::$SUCCESS_RESPONSE);

        // XXX: I couldn't get this request to work, so this is just an error case
        $senderProfile = new SenderProfile('TU_GRAZ', '1.0');
        $request = new DualDeliveryCancellationRequest($senderProfile, 'foo', '132487', '1.0');
        $response = $service->dualDeliveryCancellationRequestOperation($request);
        $this->assertSame('132487', $response->getDualDeliveryID());
        $this->assertSame('39', $response->getStatus()->getCode());
    }
}
