<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class NotificationsPerformed
{
    /**
     * @var RecipientNotification
     */
    protected $RecipientNotification;

    public function __construct(RecipientNotification $RecipientNotification)
    {
        $this->RecipientNotification = $RecipientNotification;
    }

    public function getRecipientNotification(): RecipientNotification
    {
        return $this->RecipientNotification;
    }

    public function setRecipientNotification(RecipientNotification $RecipientNotification): void
    {
        $this->RecipientNotification = $RecipientNotification;
    }
}
