<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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
     * @param string $AppDeliveryID
     *
     * @return DualNotificationRequestType
     */
    public function setAppDeliveryID($AppDeliveryID)
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
     * @param string $DualDeliveryID
     *
     * @return DualNotificationRequestType
     */
    public function setDualDeliveryID($DualDeliveryID)
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
     * @param Result $Result
     *
     * @return DualNotificationRequestType
     */
    public function setResult($Result)
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
     * @param AdditionalResults $AdditionalResults
     *
     * @return DualNotificationRequestType
     */
    public function setAdditionalResults($AdditionalResults)
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
     * @param ManipulatedPayloadsType $ManipulatedPayloads
     *
     * @return DualNotificationRequestType
     */
    public function setManipulatedPayloads($ManipulatedPayloads)
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
     * @param StatusType $Status
     *
     * @return DualNotificationRequestType
     */
    public function setStatus($Status)
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
     * @param string $version
     *
     * @return DualNotificationRequestType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
