<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class RecipientNotification
{
    /**
     * @var NotificationMethod
     */
    protected $NotificationMethod = null;

    /**
     * @var \DateTime
     */
    protected $Timestamp = null;

    /**
     * @param NotificationMethod $NotificationMethod
     */
    public function __construct($NotificationMethod, \DateTime $Timestamp)
    {
        $this->NotificationMethod = $NotificationMethod;
        $this->Timestamp = $Timestamp->format(\DateTime::ATOM);
    }

    /**
     * @return NotificationMethod
     */
    public function getNotificationMethod()
    {
        return $this->NotificationMethod;
    }

    /**
     * @param NotificationMethod $NotificationMethod
     */
    public function setNotificationMethod($NotificationMethod): self
    {
        $this->NotificationMethod = $NotificationMethod;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp()
    {
        if ($this->Timestamp === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->Timestamp);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    public function setTimestamp(\DateTime $Timestamp): self
    {
        $this->Timestamp = $Timestamp->format(\DateTime::ATOM);

        return $this;
    }
}
