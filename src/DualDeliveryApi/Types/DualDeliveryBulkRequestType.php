<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DualDeliveryBulkRequestType
{
    /**
     * @var Sender
     */
    protected $Sender = null;

    /**
     * @var MetaData
     */
    protected $MetaData = null;

    /**
     * @var PayloadType
     */
    protected $Payload = null;

    /**
     * @var bool
     */
    protected $StartBulk = null;

    /**
     * @var FinishBulk
     */
    protected $FinishBulk = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param Sender      $Sender
     * @param MetaData    $MetaData
     * @param PayloadType $Payload
     * @param bool        $StartBulk
     * @param FinishBulk  $FinishBulk
     * @param string      $version
     */
    public function __construct($Sender, $MetaData, $Payload, $StartBulk, $FinishBulk, $version)
    {
        $this->Sender = $Sender;
        $this->MetaData = $MetaData;
        $this->Payload = $Payload;
        $this->StartBulk = $StartBulk;
        $this->FinishBulk = $FinishBulk;
        $this->version = $version;
    }

    /**
     * @return Sender
     */
    public function getSender()
    {
        return $this->Sender;
    }

    /**
     * @param Sender $Sender
     *
     * @return DualDeliveryBulkRequestType
     */
    public function setSender($Sender)
    {
        $this->Sender = $Sender;

        return $this;
    }

    /**
     * @return MetaData
     */
    public function getMetaData()
    {
        return $this->MetaData;
    }

    /**
     * @param MetaData $MetaData
     *
     * @return DualDeliveryBulkRequestType
     */
    public function setMetaData($MetaData)
    {
        $this->MetaData = $MetaData;

        return $this;
    }

    /**
     * @return PayloadType
     */
    public function getPayload()
    {
        return $this->Payload;
    }

    /**
     * @param PayloadType $Payload
     *
     * @return DualDeliveryBulkRequestType
     */
    public function setPayload($Payload)
    {
        $this->Payload = $Payload;

        return $this;
    }

    /**
     * @return bool
     */
    public function getStartBulk()
    {
        return $this->StartBulk;
    }

    /**
     * @param bool $StartBulk
     *
     * @return DualDeliveryBulkRequestType
     */
    public function setStartBulk($StartBulk)
    {
        $this->StartBulk = $StartBulk;

        return $this;
    }

    /**
     * @return FinishBulk
     */
    public function getFinishBulk()
    {
        return $this->FinishBulk;
    }

    /**
     * @param FinishBulk $FinishBulk
     *
     * @return DualDeliveryBulkRequestType
     */
    public function setFinishBulk($FinishBulk)
    {
        $this->FinishBulk = $FinishBulk;

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
     * @return DualDeliveryBulkRequestType
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
