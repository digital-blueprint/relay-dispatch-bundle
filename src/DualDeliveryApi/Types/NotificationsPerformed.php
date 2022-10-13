<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return RecipientNotification
     */
    public function getRecipientNotification()
    {
        return $this->RecipientNotification;
    }

    /**
     * @param RecipientNotification $RecipientNotification
     *
     * @return NotificationsPerformed
     */
    public function setRecipientNotification($RecipientNotification)
    {
        $this->RecipientNotification = $RecipientNotification;

        return $this;
    }
}
