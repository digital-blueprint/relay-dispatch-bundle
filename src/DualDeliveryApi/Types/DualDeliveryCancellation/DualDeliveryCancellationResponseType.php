<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryCancellation;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\StatusType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk\BulkElements;

class DualDeliveryCancellationResponseType
{
    /**
     * @var string
     */
    protected $DualDeliveryID;

    /**
     * @var string
     */
    protected $AppDeliveryID;

    /**
     * @var StatusType
     */
    protected $Status;

    /**
     * @var BulkElements
     */
    protected $BulkElements;

    /**
     * @var string
     */
    protected $version;

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
     * @return DualDeliveryCancellationResponseType
     */
    public function setDualDeliveryID(string $DualDeliveryID)
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
     * @return DualDeliveryCancellationResponseType
     */
    public function setAppDeliveryID(string $AppDeliveryID)
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
     * @return DualDeliveryCancellationResponseType
     */
    public function setStatus(StatusType $Status)
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
     * @return DualDeliveryCancellationResponseType
     */
    public function setBulkElements(BulkElements $BulkElements)
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
     * @return DualDeliveryCancellationResponseType
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }
}
