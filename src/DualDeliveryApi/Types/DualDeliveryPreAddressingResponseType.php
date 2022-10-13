<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DualDeliveryPreAddressingResponseType
{
    /**
     * @var string
     */
    protected $AppDeliveryID = null;

    /**
     * @var StatusType
     */
    protected $Status = null;

    /**
     * @var string
     */
    protected $DualDeliveryID = null;

    /**
     * @var AddressingResults
     */
    protected $AddressingResults = null;

    /**
     * @var ErrorsType
     */
    protected $Errors = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param string     $AppDeliveryID
     * @param StatusType $Status
     * @param string     $DualDeliveryID
     * @param ErrorsType $Errors
     * @param string     $version
     */
    public function __construct($AppDeliveryID, $Status, $DualDeliveryID, $Errors, $version)
    {
        $this->AppDeliveryID = $AppDeliveryID;
        $this->Status = $Status;
        $this->DualDeliveryID = $DualDeliveryID;
        $this->Errors = $Errors;
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
     * @return DualDeliveryPreAddressingResponseType
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
     * @return DualDeliveryPreAddressingResponseType
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;

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
     * @return DualDeliveryPreAddressingResponseType
     */
    public function setDualDeliveryID($DualDeliveryID)
    {
        $this->DualDeliveryID = $DualDeliveryID;

        return $this;
    }

    /**
     * @return AddressingResults
     */
    public function getAddressingResults()
    {
        return $this->AddressingResults;
    }

    /**
     * @param AddressingResults $AddressingResults
     *
     * @return DualDeliveryPreAddressingResponseType
     */
    public function setAddressingResults($AddressingResults)
    {
        $this->AddressingResults = $AddressingResults;

        return $this;
    }

    /**
     * @return ErrorsType
     */
    public function getErrors()
    {
        return $this->Errors;
    }

    /**
     * @param ErrorsType $Errors
     *
     * @return DualDeliveryPreAddressingResponseType
     */
    public function setErrors($Errors)
    {
        $this->Errors = $Errors;

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
     * @return DualDeliveryPreAddressingResponseType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
