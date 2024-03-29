<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse\DeliveryNotification;

class EDeliveryNotificationType extends NotificationChannelSetType
{
    /**
     * @var DeliveryNotification
     */
    protected $DeliveryNotification;

    /**
     * @var string
     */
    protected $BinaryDeliveryNotification;

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
