<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class SubjectConfirmationType
{
    /**
     * @var AnyURI
     */
    protected $ConfirmationMethod = null;

    /**
     * @var mixed
     */
    protected $SubjectConfirmationData = null;

    /**
     * @var KeyInfoType
     */
    protected $KeyInfo = null;

    /**
     * @param AnyURI      $ConfirmationMethod
     * @param mixed       $SubjectConfirmationData
     * @param KeyInfoType $KeyInfo
     */
    public function __construct($ConfirmationMethod, $SubjectConfirmationData, $KeyInfo)
    {
        $this->ConfirmationMethod = $ConfirmationMethod;
        $this->SubjectConfirmationData = $SubjectConfirmationData;
        $this->KeyInfo = $KeyInfo;
    }

    /**
     * @return AnyURI
     */
    public function getConfirmationMethod()
    {
        return $this->ConfirmationMethod;
    }

    /**
     * @param AnyURI $ConfirmationMethod
     *
     * @return SubjectConfirmationType
     */
    public function setConfirmationMethod($ConfirmationMethod)
    {
        $this->ConfirmationMethod = $ConfirmationMethod;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubjectConfirmationData()
    {
        return $this->SubjectConfirmationData;
    }

    /**
     * @param mixed $SubjectConfirmationData
     *
     * @return SubjectConfirmationType
     */
    public function setSubjectConfirmationData($SubjectConfirmationData)
    {
        $this->SubjectConfirmationData = $SubjectConfirmationData;

        return $this;
    }

    /**
     * @return KeyInfoType
     */
    public function getKeyInfo()
    {
        return $this->KeyInfo;
    }

    /**
     * @param KeyInfoType $KeyInfo
     *
     * @return SubjectConfirmationType
     */
    public function setKeyInfo($KeyInfo)
    {
        $this->KeyInfo = $KeyInfo;

        return $this;
    }
}
