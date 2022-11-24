<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

class DualNotificationBulkResponseType
{
    /**
     * @var DualNotificationResponses[]
     */
    protected $DualNotificationResponses = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param DualNotificationResponses[] $DualNotificationResponses
     */
    public function __construct(array $DualNotificationResponses, string $version)
    {
        $this->DualNotificationResponses = $DualNotificationResponses;
        $this->version = $version;
    }

    /**
     * @return DualNotificationResponses[]
     */
    public function getDualNotificationResponses(): array
    {
        return $this->DualNotificationResponses;
    }

    /**
     * @param DualNotificationResponses[] $DualNotificationResponses
     */
    public function setDualNotificationResponses(array $DualNotificationResponses): void
    {
        $this->DualNotificationResponses = $DualNotificationResponses;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }
}
