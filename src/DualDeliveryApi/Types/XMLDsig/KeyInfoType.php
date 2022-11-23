<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class KeyInfoType
{
    /**
     * @var string
     */
    protected $KeyName = null;

    /**
     * @var KeyValueType
     */
    protected $KeyValue = null;

    /**
     * @var RetrievalMethodType
     */
    protected $RetrievalMethod = null;

    /**
     * @var X509DataType
     */
    protected $X509Data = null;

    /**
     * @var PGPDataType
     */
    protected $PGPData = null;

    /**
     * @var SPKIDataType
     */
    protected $SPKIData = null;

    /**
     * @var string
     */
    protected $MgmtData = null;

    /**
     * @var string
     */
    protected $any = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param string              $KeyName
     * @param KeyValueType        $KeyValue
     * @param RetrievalMethodType $RetrievalMethod
     * @param X509DataType        $X509Data
     * @param PGPDataType         $PGPData
     * @param SPKIDataType        $SPKIData
     * @param string              $MgmtData
     * @param string              $any
     * @param string              $Id
     */
    public function __construct($KeyName, $KeyValue, $RetrievalMethod, $X509Data, $PGPData, $SPKIData, $MgmtData, $any, $Id)
    {
        $this->KeyName = $KeyName;
        $this->KeyValue = $KeyValue;
        $this->RetrievalMethod = $RetrievalMethod;
        $this->X509Data = $X509Data;
        $this->PGPData = $PGPData;
        $this->SPKIData = $SPKIData;
        $this->MgmtData = $MgmtData;
        $this->any = $any;
        $this->Id = $Id;
    }

    public function getKeyName(): string
    {
        return $this->KeyName;
    }

    public function setKeyName(string $KeyName): self
    {
        $this->KeyName = $KeyName;

        return $this;
    }

    public function getKeyValue(): KeyValueType
    {
        return $this->KeyValue;
    }

    public function setKeyValue(KeyValueType $KeyValue): self
    {
        $this->KeyValue = $KeyValue;

        return $this;
    }

    public function getRetrievalMethod(): RetrievalMethodType
    {
        return $this->RetrievalMethod;
    }

    public function setRetrievalMethod(RetrievalMethodType $RetrievalMethod): self
    {
        $this->RetrievalMethod = $RetrievalMethod;

        return $this;
    }

    public function getX509Data(): X509DataType
    {
        return $this->X509Data;
    }

    public function setX509Data(X509DataType $X509Data): self
    {
        $this->X509Data = $X509Data;

        return $this;
    }

    public function getPGPData(): PGPDataType
    {
        return $this->PGPData;
    }

    public function setPGPData(PGPDataType $PGPData): self
    {
        $this->PGPData = $PGPData;

        return $this;
    }

    public function getSPKIData(): SPKIDataType
    {
        return $this->SPKIData;
    }

    public function setSPKIData(SPKIDataType $SPKIData): self
    {
        $this->SPKIData = $SPKIData;

        return $this;
    }

    public function getMgmtData(): string
    {
        return $this->MgmtData;
    }

    public function setMgmtData(string $MgmtData): self
    {
        $this->MgmtData = $MgmtData;

        return $this;
    }

    public function getAny(): string
    {
        return $this->any;
    }

    public function setAny(string $any): self
    {
        $this->any = $any;

        return $this;
    }

    public function getId(): string
    {
        return $this->Id;
    }

    public function setId(string $Id): self
    {
        $this->Id = $Id;

        return $this;
    }
}
