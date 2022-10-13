<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DualNotificationBulkRequestType
{
    /**
     * @var string
     */
    protected $ApplicationDeliveryID = null;

    /**
     * @var int
     */
    protected $DualZSID = null;

    /**
     * @var BulkElements
     */
    protected $BulkElements = null;

    /**
     * @var StatusType
     */
    protected $Status = null;

    /**
     * @var ErrorsType
     */
    protected $Errors = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param string       $ApplicationDeliveryID
     * @param BulkElements $BulkElements
     * @param StatusType   $Status
     * @param ErrorsType   $Errors
     * @param string       $version
     */
    public function __construct($ApplicationDeliveryID, $BulkElements, $Status, $Errors, $version)
    {
        $this->ApplicationDeliveryID = $ApplicationDeliveryID;
        $this->BulkElements = $BulkElements;
        $this->Status = $Status;
        $this->Errors = $Errors;
        $this->version = $version;
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
     * @return DualNotificationBulkRequestType
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
     * @return DualNotificationBulkRequestType
     */
    public function setDualZSID($DualZSID)
    {
        $this->DualZSID = $DualZSID;

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
     * @return DualNotificationBulkRequestType
     */
    public function setBulkElements($BulkElements)
    {
        $this->BulkElements = $BulkElements;

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
     * @return DualNotificationBulkRequestType
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;

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
     * @return DualNotificationBulkRequestType
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
     * @return DualNotificationBulkRequestType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
