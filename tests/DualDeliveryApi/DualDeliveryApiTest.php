<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests\DualDeliveryApi;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\DualDeliveryClient;
use PHPUnit\Framework\TestCase;

class DualDeliveryApiTest extends TestCase
{
    public function testCreateClient()
    {
        $client = new DualDeliveryClient('https://dualtest.vendo.at/');
        $this->assertNotNull($client);
    }

    public function testClassMap()
    {
        $client = new DualDeliveryClient('https://dualtest.vendo.at/');
        foreach ($client->getClassMap() as $key => $value) {
            $this->assertTrue(class_exists($value), $value);
        }
    }
}
