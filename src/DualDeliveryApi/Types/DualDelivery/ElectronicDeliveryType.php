<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class ElectronicDeliveryType extends DeliveryChannelSetType
{
    /**
     * @var bool
     */
    protected $RequiresEncryption;

    /**
     * @var bool
     */
    protected $DeliveryConfirmation;

    /**
     * @var CustomNotificationIntervals
     */
    protected $CustomNotificationIntervals;

    public function getRequiresEncryption(): bool
    {
        return $this->RequiresEncryption;
    }

    public function setRequiresEncryption(bool $RequiresEncryption): void
    {
        $this->RequiresEncryption = $RequiresEncryption;
    }

    public function getDeliveryConfirmation(): bool
    {
        return $this->DeliveryConfirmation;
    }

    public function setDeliveryConfirmation(bool $DeliveryConfirmation): void
    {
        $this->DeliveryConfirmation = $DeliveryConfirmation;
    }

    public function getCustomNotificationIntervals(): CustomNotificationIntervals
    {
        return $this->CustomNotificationIntervals;
    }

    public function setCustomNotificationIntervals(CustomNotificationIntervals $CustomNotificationIntervals): void
    {
        $this->CustomNotificationIntervals = $CustomNotificationIntervals;
    }
}
