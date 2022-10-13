<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class StatusRequestType
{
    /**
     * @var ApplicationID
     */
    protected $ApplicationID = null;

    /**
     * @var string
     */
    protected $ApplicationDeliveryID = null;

    /**
     * @var string
     */
    protected $DualDeliveryID = null;

    /**
     * @param ApplicationID $ApplicationID
     * @param string        $AppDeliveryID
     */
    public function __construct($ApplicationID, $ApplicationDeliveryID)
    {
        $this->ApplicationID = $ApplicationID;
        $this->ApplicationDeliveryID = $ApplicationDeliveryID;
    }

    /**
     * @return ApplicationID
     */
    public function getApplicationID()
    {
        return $this->ApplicationID;
    }

    /**
     * @param ApplicationID $ApplicationID
     *
     * @return StatusRequestType
     */
    public function setApplicationID($ApplicationID)
    {
        $this->ApplicationID = $ApplicationID;

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
     * @return StatusRequestType
     */
    public function setApplicationDeliveryID($ApplicationDeliveryID)
    {
        $this->ApplicationDeliveryID = $ApplicationDeliveryID;

        return $this;
    }

    /**
     * @return string
     */
    public function getDualDeliveryID()
    {
        return $this->DualDeliveryID;
    }

    /**
     * @param string $DualDeliveryID
     *
     * @return StatusRequestType
     */
    public function setDualDeliveryID($DualDeliveryID)
    {
        $this->DualDeliveryID = $DualDeliveryID;

        return $this;
    }
}
