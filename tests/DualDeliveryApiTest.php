<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\DualDeliveryService;
use PHPUnit\Framework\TestCase;

class DualDeliveryApiTest extends TestCase
{
    public function testCreateClient()
    {
        $client = new DualDeliveryService('https://dualtest.vendo.at/');
        $this->assertNotNull($client);
    }
}
