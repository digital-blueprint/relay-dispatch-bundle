<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class EDeliveryNotificationType extends NotificationChannelSetType
{
    /**
     * @var DeliveryNotification
     */
    protected $DeliveryNotification = null;

    /**
     * @var base64Binary
     */
    protected $BinaryDeliveryNotification = null;

    /**
     * @param DeliveryNotification $DeliveryNotification
     * @param base64Binary         $BinaryDeliveryNotification
     */
    public function __construct($DeliveryNotification, $BinaryDeliveryNotification)
    {
        $this->DeliveryNotification = $DeliveryNotification;
        $this->BinaryDeliveryNotification = $BinaryDeliveryNotification;
    }

    /**
     * @return DeliveryNotification
     */
    public function getDeliveryNotification()
    {
        return $this->DeliveryNotification;
    }

    /**
     * @param DeliveryNotification $DeliveryNotification
     *
     * @return EDeliveryNotificationType
     */
    public function setDeliveryNotification($DeliveryNotification)
    {
        $this->DeliveryNotification = $DeliveryNotification;

        return $this;
    }

    /**
     * @return base64Binary
     */
    public function getBinaryDeliveryNotification()
    {
        return $this->BinaryDeliveryNotification;
    }

    /**
     * @param base64Binary $BinaryDeliveryNotification
     *
     * @return EDeliveryNotificationType
     */
    public function setBinaryDeliveryNotification($BinaryDeliveryNotification)
    {
        $this->BinaryDeliveryNotification = $BinaryDeliveryNotification;

        return $this;
    }
}
