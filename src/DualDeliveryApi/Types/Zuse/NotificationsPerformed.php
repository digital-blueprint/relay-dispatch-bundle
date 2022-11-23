<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\RecipientNotification;

class NotificationsPerformed
{
    /**
     * @var RecipientNotification
     */
    protected $RecipientNotification = null;

    /**
     * @param RecipientNotification $RecipientNotification
     */
    public function __construct($RecipientNotification)
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
