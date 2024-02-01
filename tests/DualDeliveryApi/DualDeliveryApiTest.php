<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests\DualDeliveryApi;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\DualDeliveryClient;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\StatusType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk\DualNotificationBulkRequestType;
use PHPUnit\Framework\TestCase;

class DualDeliveryApiTest extends TestCase
{
    public function testCreateClient()
    {
        $client = new DualDeliveryClient('https://dualtest.vendo.at/');
        $this->assertNotNull($client);
    }

    public function testUnsupportedOperation()
    {
        $client = new DualDeliveryClient('https://dualtest.vendo.at/');
        $param = new DualNotificationBulkRequestType(
            'foo', null, new StatusType('bar'), null, '1.0');
        $this->expectException(\SoapFault::class);
        $this->expectExceptionMessageMatches("/doesn't provide dualNotificationBulkRequestOperation/");
        $client->dualNotificationBulkRequestOperation($param);
    }

    public function testClassMap()
    {
        $client = new DualDeliveryClient('https://dualtest.vendo.at/');
        foreach ($client->getClassMap() as $key => $value) {
            $this->assertTrue(class_exists($value), $value);
        }
    }

    public function testCreateClientUnknownLocation()
    {
        $client = new DualDeliveryClient('https://nope-doesnt-exist.com/');
        $this->assertNotNull($client);
    }
}
