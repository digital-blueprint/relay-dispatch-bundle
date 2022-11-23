<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig\KeyInfoType;

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

    public function getConfirmationMethod(): AnyURI
    {
        return $this->ConfirmationMethod;
    }

    public function setConfirmationMethod(AnyURI $ConfirmationMethod): self
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
     */
    public function setSubjectConfirmationData($SubjectConfirmationData): self
    {
        $this->SubjectConfirmationData = $SubjectConfirmationData;

        return $this;
    }

    public function getKeyInfo(): KeyInfoType
    {
        return $this->KeyInfo;
    }

    public function setKeyInfo(KeyInfoType $KeyInfo): self
    {
        $this->KeyInfo = $KeyInfo;

        return $this;
    }
}
