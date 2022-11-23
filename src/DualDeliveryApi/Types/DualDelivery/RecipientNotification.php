<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class RecipientNotification
{
    /**
     * @var string
     */
    protected $NotificationMethod = null;

    /**
     * @var string
     */
    protected $TimeSinceDisposal = null;

    public function __construct(string $NotificationMethod, string $TimeSinceDisposal)
    {
        $this->NotificationMethod = $NotificationMethod;
        $this->TimeSinceDisposal = $TimeSinceDisposal;
    }

    public function getNotificationMethod(): string
    {
        return $this->NotificationMethod;
    }

    public function setNotificationMethod(string $NotificationMethod): void
    {
        $this->NotificationMethod = $NotificationMethod;
    }

    public function getTimeSinceDisposal(): string
    {
        return $this->TimeSinceDisposal;
    }

    public function setTimeSinceDisposal(string $TimeSinceDisposal): void
    {
        $this->TimeSinceDisposal = $TimeSinceDisposal;
    }
}
