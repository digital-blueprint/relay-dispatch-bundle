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
     * @var string
     */
    protected $BinaryDeliveryNotification = null;

    public function __construct(DeliveryNotification $DeliveryNotification, string $BinaryDeliveryNotification)
    {
        parent::__construct();
        $this->DeliveryNotification = $DeliveryNotification;
        $this->BinaryDeliveryNotification = $BinaryDeliveryNotification;
    }

    public function getDeliveryNotification(): DeliveryNotification
    {
        return $this->DeliveryNotification;
    }

    public function setDeliveryNotification(DeliveryNotification $DeliveryNotification): void
    {
        $this->DeliveryNotification = $DeliveryNotification;
    }

    public function getBinaryDeliveryNotification(): string
    {
        return $this->BinaryDeliveryNotification;
    }

    public function setBinaryDeliveryNotification($BinaryDeliveryNotification): void
    {
        $this->BinaryDeliveryNotification = $BinaryDeliveryNotification;
    }
}
