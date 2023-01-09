<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class CustomNotificationIntervals
{
    /**
     * @var RecipientNotification[]
     */
    protected $RecipientNotification = null;

    /**
     * @param RecipientNotification[] $RecipientNotification
     */
    public function __construct(array $RecipientNotification)
    {
        $this->RecipientNotification = $RecipientNotification;
    }

    /**
     * @return RecipientNotification[]
     */
    public function getRecipientNotification(): array
    {
        return $this->RecipientNotification;
    }

    /**
     * @param RecipientNotification[] $RecipientNotification
     */
    public function setRecipientNotification(array $RecipientNotification): void
    {
        $this->RecipientNotification = $RecipientNotification;
    }
}
