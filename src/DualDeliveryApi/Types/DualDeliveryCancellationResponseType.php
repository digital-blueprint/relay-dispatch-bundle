<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DualDeliveryCancellationResponseType
{
    /**
     * @var string
     */
    protected $DualDeliveryID = null;

    /**
     * @var string
     */
    protected $AppDeliveryID = null;

    /**
     * @var StatusType
     */
    protected $Status = null;

    /**
     * @var BulkElements
     */
    protected $BulkElements = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param string       $DualDeliveryID
     * @param string       $AppDeliveryID
     * @param StatusType   $Status
     * @param BulkElements $BulkElements
     * @param string       $version
     */
    public function __construct($DualDeliveryID, $AppDeliveryID, $Status, $BulkElements, $version)
    {
        $this->DualDeliveryID = $DualDeliveryID;
        $this->AppDeliveryID = $AppDeliveryID;
        $this->Status = $Status;
        $this->BulkElements = $BulkElements;
        $this->version = $version;
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
     * @return DualDeliveryCancellationResponseType
     */
    public function setDualDeliveryID($DualDeliveryID)
    {
        $this->DualDeliveryID = $DualDeliveryID;

        return $this;
    }

    /**
     * @return string
     */
    public function getAppDeliveryID()
    {
        return $this->AppDeliveryID;
    }

    /**
     * @param string $AppDeliveryID
     *
     * @return DualDeliveryCancellationResponseType
     */
    public function setAppDeliveryID($AppDeliveryID)
    {
        $this->AppDeliveryID = $AppDeliveryID;

        return $this;
    }

    /**
     * @return StatusType
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @param StatusType $Status
     *
     * @return DualDeliveryCancellationResponseType
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;

        return $this;
    }

    /**
     * @return BulkElements
     */
    public function getBulkElements()
    {
        return $this->BulkElements;
    }

    /**
     * @param BulkElements $BulkElements
     *
     * @return DualDeliveryCancellationResponseType
     */
    public function setBulkElements($BulkElements)
    {
        $this->BulkElements = $BulkElements;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return DualDeliveryCancellationResponseType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
