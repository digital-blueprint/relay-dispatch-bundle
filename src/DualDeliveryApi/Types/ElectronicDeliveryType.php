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

    /**
     * @return bool
     */
    public function getRequiresEncryption()
    {
        return $this->RequiresEncryption;
    }

    /**
     * @param bool $RequiresEncryption
     *
     * @return ElectronicDeliveryType
     */
    public function setRequiresEncryption($RequiresEncryption)
    {
        $this->RequiresEncryption = $RequiresEncryption;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDeliveryConfirmation()
    {
        return $this->DeliveryConfirmation;
    }

    /**
     * @param bool $DeliveryConfirmation
     *
     * @return ElectronicDeliveryType
     */
    public function setDeliveryConfirmation($DeliveryConfirmation)
    {
        $this->DeliveryConfirmation = $DeliveryConfirmation;

        return $this;
    }

    /**
     * @return CustomNotificationIntervals
     */
    public function getCustomNotificationIntervals()
    {
        return $this->CustomNotificationIntervals;
    }

    /**
     * @param CustomNotificationIntervals $CustomNotificationIntervals
     *
     * @return ElectronicDeliveryType
     */
    public function setCustomNotificationIntervals($CustomNotificationIntervals)
    {
        $this->CustomNotificationIntervals = $CustomNotificationIntervals;

        return $this;
    }
}
