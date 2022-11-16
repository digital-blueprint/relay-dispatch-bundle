<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests\DualDeliveryApi;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\DualDeliveryService;

trait BaseSoapTrait
{
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
}
