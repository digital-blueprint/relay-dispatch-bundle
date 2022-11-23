<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class SignedInfoType
{
    /**
     * @var CanonicalizationMethodType
     */
    protected $CanonicalizationMethod = null;

    /**
     * @var SignatureMethodType
     */
    protected $SignatureMethod = null;

    /**
     * @var ReferenceType
     */
    protected $Reference = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param CanonicalizationMethodType $CanonicalizationMethod
     * @param SignatureMethodType        $SignatureMethod
     * @param ReferenceType              $Reference
     * @param string                     $Id
     */
    public function __construct($CanonicalizationMethod, $SignatureMethod, $Reference, $Id)
    {
        $this->CanonicalizationMethod = $CanonicalizationMethod;
        $this->SignatureMethod = $SignatureMethod;
        $this->Reference = $Reference;
        $this->Id = $Id;
    }

    public function getCanonicalizationMethod(): CanonicalizationMethodType
    {
        return $this->CanonicalizationMethod;
    }

    public function setCanonicalizationMethod(CanonicalizationMethodType $CanonicalizationMethod): self
    {
        $this->CanonicalizationMethod = $CanonicalizationMethod;

        return $this;
    }

    public function getSignatureMethod(): SignatureMethodType
    {
        return $this->SignatureMethod;
    }

    public function setSignatureMethod(SignatureMethodType $SignatureMethod): self
    {
        $this->SignatureMethod = $SignatureMethod;

        return $this;
    }

    public function getReference(): ReferenceType
    {
        return $this->Reference;
    }

    public function setReference(ReferenceType $Reference): self
    {
        $this->Reference = $Reference;

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
