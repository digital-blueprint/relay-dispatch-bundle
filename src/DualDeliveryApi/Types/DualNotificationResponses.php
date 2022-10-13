<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DualNotificationResponses
{
    /**
     * @var DualNotificationResponseType
     */
    protected $DualNotificationResponse = null;

    /**
     * @var string
     */
    protected $ApplicationDeliveryID = null;

    /**
     * @var int
     */
    protected $DualZSID = null;

    /**
     * @param DualNotificationResponseType $DualNotificationResponse
     * @param string                       $ApplicationDeliveryID
     * @param int                          $DualZSID
     */
    public function __construct($DualNotificationResponse, $ApplicationDeliveryID, $DualZSID)
    {
        $this->DualNotificationResponse = $DualNotificationResponse;
        $this->ApplicationDeliveryID = $ApplicationDeliveryID;
        $this->DualZSID = $DualZSID;
    }

    /**
     * @return DualNotificationResponseType
     */
    public function getDualNotificationResponse()
    {
        return $this->DualNotificationResponse;
    }

    /**
     * @param DualNotificationResponseType $DualNotificationResponse
     *
     * @return DualNotificationResponses
     */
    public function setDualNotificationResponse($DualNotificationResponse)
    {
        $this->DualNotificationResponse = $DualNotificationResponse;

        return $this;
    }

    /**
     * @return string
     */
    public function getApplicationDeliveryID()
    {
        return $this->ApplicationDeliveryID;
    }

    /**
     * @param string $ApplicationDeliveryID
     *
     * @return DualNotificationResponses
     */
    public function setApplicationDeliveryID($ApplicationDeliveryID)
    {
        $this->ApplicationDeliveryID = $ApplicationDeliveryID;

        return $this;
    }

    /**
     * @return int
     */
    public function getDualZSID()
    {
        return $this->DualZSID;
    }

    /**
     * @param int $DualZSID
     *
     * @return DualNotificationResponses
     */
    public function setDualZSID($DualZSID)
    {
        $this->DualZSID = $DualZSID;

        return $this;
    }
}
