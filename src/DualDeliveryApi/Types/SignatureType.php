<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class SignatureType
{
    /**
     * @var SignedInfoType
     */
    protected $SignedInfo = null;

    /**
     * @var SignatureValueType
     */
    protected $SignatureValue = null;

    /**
     * @var KeyInfoType
     */
    protected $KeyInfo = null;

    /**
     * @var ObjectType
     */
    protected $Object = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param SignedInfoType     $SignedInfo
     * @param SignatureValueType $SignatureValue
     * @param KeyInfoType        $KeyInfo
     * @param ObjectType         $Object
     * @param string             $Id
     */
    public function __construct($SignedInfo, $SignatureValue, $KeyInfo, $Object, $Id)
    {
        $this->SignedInfo = $SignedInfo;
        $this->SignatureValue = $SignatureValue;
        $this->KeyInfo = $KeyInfo;
        $this->Object = $Object;
        $this->Id = $Id;
    }

    public function getSignedInfo(): SignedInfoType
    {
        return $this->SignedInfo;
    }

    public function setSignedInfo(SignedInfoType $SignedInfo): self
    {
        $this->SignedInfo = $SignedInfo;

        return $this;
    }

    public function getSignatureValue(): SignatureValueType
    {
        return $this->SignatureValue;
    }

    public function setSignatureValue(SignatureValueType $SignatureValue): self
    {
        $this->SignatureValue = $SignatureValue;

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

    public function getObject(): ObjectType
    {
        return $this->Object;
    }

    public function setObject(ObjectType $Object): self
    {
        $this->Object = $Object;

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
