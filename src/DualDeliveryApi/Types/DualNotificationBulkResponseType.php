<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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
     * @param string                      $version
     */
    public function __construct(array $DualNotificationResponses, $version)
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
    public function setDualNotificationResponses(array $DualNotificationResponses): self
    {
        $this->DualNotificationResponses = $DualNotificationResponses;

        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }
}
