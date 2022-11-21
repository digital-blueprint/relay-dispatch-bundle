<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Tests;

use Dbp\Relay\DispatchBundle\Service\DualDeliveryService;
use PHPUnit\Framework\TestCase;

class DualDeliveryServiceTest extends TestCase
{
    /**
     * @var DualDeliveryService
     */
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = new DualDeliveryService();
        $this->service->setConfig([
            'sender_profile' => 'FOO',
            'sender_profile_version' => '42.0',
        ]);
    }

    public function testProfile()
    {
        $profile = $this->service->getSenderProfile();
        $this->assertSame('FOO', $profile->get_());
        $this->assertSame('42.0', $profile->getVersion());
    }

    public function testIDs()
    {
        $appId = $this->service->getApplicationID();
        $this->assertSame('relay-dispatch-bundle', $appId->get_());
        $this->assertSame('0.1', $appId->getVersion());

        // These should be unique
        $this->assertNotSame($this->service->createAppDeliveryID(), $this->service->createAppDeliveryID());
        $this->assertNotSame($this->service->createRecipientID(), $this->service->createRecipientID());
    }
}
