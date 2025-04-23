<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig\KeyInfoType;

class SubjectConfirmationType
{
    /**
     * @var string
     */
    protected $ConfirmationMethod;

    /**
     * @var mixed
     */
    protected $SubjectConfirmationData;

    /**
     * @var KeyInfoType
     */
    protected $KeyInfo;

    /**
     * @param string      $ConfirmationMethod
     * @param mixed       $SubjectConfirmationData
     * @param KeyInfoType $KeyInfo
     */
    public function __construct($ConfirmationMethod, $SubjectConfirmationData, $KeyInfo)
    {
        $this->ConfirmationMethod = $ConfirmationMethod;
        $this->SubjectConfirmationData = $SubjectConfirmationData;
        $this->KeyInfo = $KeyInfo;
    }

    public function getConfirmationMethod(): string
    {
        return $this->ConfirmationMethod;
    }

    public function setConfirmationMethod(string $ConfirmationMethod): self
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
