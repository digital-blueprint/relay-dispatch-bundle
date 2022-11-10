<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ElectronicDeliveryType extends DeliveryChannelSetType
{
    /**
     * @var bool
     */
    protected $RequiresEncryption = null;

    /**
     * @var bool
     */
    protected $DeliveryConfirmation = null;

    /**
     * @var CustomNotificationIntervals
     */
    protected $CustomNotificationIntervals = null;

    public function __construct()
    {
    }

    public function getRequiresEncryption(): bool
    {
        return $this->RequiresEncryption;
    }

    public function setRequiresEncryption(bool $RequiresEncryption): self
    {
        $this->RequiresEncryption = $RequiresEncryption;

        return $this;
    }

    public function getDeliveryConfirmation(): bool
    {
        return $this->DeliveryConfirmation;
    }

    public function setDeliveryConfirmation(bool $DeliveryConfirmation): self
    {
        $this->DeliveryConfirmation = $DeliveryConfirmation;

        return $this;
    }

    public function getCustomNotificationIntervals(): CustomNotificationIntervals
    {
        return $this->CustomNotificationIntervals;
    }

    public function setCustomNotificationIntervals(CustomNotificationIntervals $CustomNotificationIntervals): self
    {
        $this->CustomNotificationIntervals = $CustomNotificationIntervals;

        return $this;
    }
}
