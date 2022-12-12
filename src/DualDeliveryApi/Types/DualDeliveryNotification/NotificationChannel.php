<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

class NotificationChannel
{
    /**
     * @var EDeliveryNotificationType
     */
    protected $EDeliveryNotification = null;

    /**
     * @var OtherNotificationType
     */
    protected $OtherNotification = null;

    /**
     * @var PostalNotificationType
     */
    protected $PostalNotification = null;

    public function __construct(?EDeliveryNotificationType $EDeliveryNotification = null, OtherNotificationType $OtherNotification = null, PostalNotificationType $PostalNotification = null)
    {
        $this->EDeliveryNotification = $EDeliveryNotification;
        $this->OtherNotification = $OtherNotification;
        $this->PostalNotification = $PostalNotification;
    }

    public function getEDeliveryNotification(): ?EDeliveryNotificationType
    {
        return $this->EDeliveryNotification;
    }

    public function setEDeliveryNotification(?EDeliveryNotificationType $EDeliveryNotification): void
    {
        $this->EDeliveryNotification = $EDeliveryNotification;
    }

    public function getPostalNotification(): ?PostalNotificationType
    {
        return $this->PostalNotification;
    }

    public function setPostalNotification(?PostalNotificationType $PostalNotification): void
    {
        $this->PostalNotification = $PostalNotification;
    }

    public function getOtherNotification(): ?OtherNotificationType
    {
        return $this->OtherNotification;
    }

    public function setOtherNotification(?OtherNotificationType $OtherNotification): void
    {
        $this->OtherNotification = $OtherNotification;
    }
}
