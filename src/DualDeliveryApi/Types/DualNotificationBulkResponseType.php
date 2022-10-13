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
    public function getDualNotificationResponses()
    {
        return $this->DualNotificationResponses;
    }

    /**
     * @param DualNotificationResponses[] $DualNotificationResponses
     *
     * @return DualNotificationBulkResponseType
     */
    public function setDualNotificationResponses(array $DualNotificationResponses)
    {
        $this->DualNotificationResponses = $DualNotificationResponses;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return DualNotificationBulkResponseType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
