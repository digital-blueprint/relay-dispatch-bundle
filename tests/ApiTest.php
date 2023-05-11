<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class ApiTest extends ApiTestCase
{
    public function testBasics()
    {
        $client = static::createClient();
        $this->assertNotNull($client);
    }
}
