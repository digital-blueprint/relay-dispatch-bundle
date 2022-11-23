<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ManipulatedPayloadsType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\StatusType;

class DualNotificationRequestType
{
    /**
     * @var string
     */
    protected $AppDeliveryID = null;

    /**
     * @var string
     */
    protected $DualDeliveryID = null;

    /**
     * @var Result
     */
    protected $Result = null;

    /**
     * @var AdditionalResults
     */
    protected $AdditionalResults = null;

    /**
     * @var ManipulatedPayloadsType
     */
    protected $ManipulatedPayloads = null;

    /**
     * @var StatusType
     */
    protected $Status = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param string            $AppDeliveryID
     * @param string            $DualDeliveryID
     * @param AdditionalResults $AdditionalResults
     * @param StatusType        $Status
     * @param string            $version
     */
    public function __construct($AppDeliveryID, $DualDeliveryID, $AdditionalResults, $Status, $version)
    {
        $this->AppDeliveryID = $AppDeliveryID;
        $this->DualDeliveryID = $DualDeliveryID;
        $this->AdditionalResults = $AdditionalResults;
        $this->Status = $Status;
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getAppDeliveryID()
    {
        return $this->AppDeliveryID;
    }

    /**
     * @return DualNotificationRequestType
     */
    public function setAppDeliveryID(string $AppDeliveryID)
    {
        $this->AppDeliveryID = $AppDeliveryID;

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
     * @return DualNotificationRequestType
     */
    public function setDualDeliveryID(string $DualDeliveryID)
    {
        $this->DualDeliveryID = $DualDeliveryID;

        return $this;
    }

    /**
     * @return Result
     */
    public function getResult()
    {
        return $this->Result;
    }

    /**
     * @return DualNotificationRequestType
     */
    public function setResult(Result $Result)
    {
        $this->Result = $Result;

        return $this;
    }

    /**
     * @return AdditionalResults
     */
    public function getAdditionalResults()
    {
        return $this->AdditionalResults;
    }

    /**
     * @return DualNotificationRequestType
     */
    public function setAdditionalResults(AdditionalResults $AdditionalResults)
    {
        $this->AdditionalResults = $AdditionalResults;

        return $this;
    }

    /**
     * @return ManipulatedPayloadsType
     */
    public function getManipulatedPayloads()
    {
        return $this->ManipulatedPayloads;
    }

    /**
     * @return DualNotificationRequestType
     */
    public function setManipulatedPayloads(ManipulatedPayloadsType $ManipulatedPayloads)
    {
        $this->ManipulatedPayloads = $ManipulatedPayloads;

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
     * @return DualNotificationRequestType
     */
    public function setStatus(StatusType $Status)
    {
        $this->Status = $Status;

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
     * @return DualNotificationRequestType
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }
}
