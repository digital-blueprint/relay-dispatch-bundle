<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests\DualDeliveryApi;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\DualDeliveryClient;

trait BaseSoapTrait
{
    /**
     * @return DualDeliveryClient
     */
    private function getMockService(string $response)
    {
        $soapClientMock = $this->getMockBuilder(DualDeliveryClient::class)
            ->setConstructorArgs(['nope', null, true])
            ->onlyMethods(['__doRequest'])
            ->getMock();
        $soapClientMock->method('__doRequest')->willReturn($response);

        return $soapClientMock;
    }
}
