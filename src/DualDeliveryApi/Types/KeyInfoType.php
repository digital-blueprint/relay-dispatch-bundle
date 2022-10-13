<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return string
     */
    public function getKeyName()
    {
        return $this->KeyName;
    }

    /**
     * @param string $KeyName
     *
     * @return KeyInfoType
     */
    public function setKeyName($KeyName)
    {
        $this->KeyName = $KeyName;

        return $this;
    }

    /**
     * @return KeyValueType
     */
    public function getKeyValue()
    {
        return $this->KeyValue;
    }

    /**
     * @param KeyValueType $KeyValue
     *
     * @return KeyInfoType
     */
    public function setKeyValue($KeyValue)
    {
        $this->KeyValue = $KeyValue;

        return $this;
    }

    /**
     * @return RetrievalMethodType
     */
    public function getRetrievalMethod()
    {
        return $this->RetrievalMethod;
    }

    /**
     * @param RetrievalMethodType $RetrievalMethod
     *
     * @return KeyInfoType
     */
    public function setRetrievalMethod($RetrievalMethod)
    {
        $this->RetrievalMethod = $RetrievalMethod;

        return $this;
    }

    /**
     * @return X509DataType
     */
    public function getX509Data()
    {
        return $this->X509Data;
    }

    /**
     * @param X509DataType $X509Data
     *
     * @return KeyInfoType
     */
    public function setX509Data($X509Data)
    {
        $this->X509Data = $X509Data;

        return $this;
    }

    /**
     * @return PGPDataType
     */
    public function getPGPData()
    {
        return $this->PGPData;
    }

    /**
     * @param PGPDataType $PGPData
     *
     * @return KeyInfoType
     */
    public function setPGPData($PGPData)
    {
        $this->PGPData = $PGPData;

        return $this;
    }

    /**
     * @return SPKIDataType
     */
    public function getSPKIData()
    {
        return $this->SPKIData;
    }

    /**
     * @param SPKIDataType $SPKIData
     *
     * @return KeyInfoType
     */
    public function setSPKIData($SPKIData)
    {
        $this->SPKIData = $SPKIData;

        return $this;
    }

    /**
     * @return string
     */
    public function getMgmtData()
    {
        return $this->MgmtData;
    }

    /**
     * @param string $MgmtData
     *
     * @return KeyInfoType
     */
    public function setMgmtData($MgmtData)
    {
        $this->MgmtData = $MgmtData;

        return $this;
    }

    /**
     * @return string
     */
    public function getAny()
    {
        return $this->any;
    }

    /**
     * @param string $any
     *
     * @return KeyInfoType
     */
    public function setAny($any)
    {
        $this->any = $any;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param string $Id
     *
     * @return KeyInfoType
     */
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }
}
