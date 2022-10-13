<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return CanonicalizationMethodType
     */
    public function getCanonicalizationMethod()
    {
        return $this->CanonicalizationMethod;
    }

    /**
     * @param CanonicalizationMethodType $CanonicalizationMethod
     *
     * @return SignedInfoType
     */
    public function setCanonicalizationMethod($CanonicalizationMethod)
    {
        $this->CanonicalizationMethod = $CanonicalizationMethod;

        return $this;
    }

    /**
     * @return SignatureMethodType
     */
    public function getSignatureMethod()
    {
        return $this->SignatureMethod;
    }

    /**
     * @param SignatureMethodType $SignatureMethod
     *
     * @return SignedInfoType
     */
    public function setSignatureMethod($SignatureMethod)
    {
        $this->SignatureMethod = $SignatureMethod;

        return $this;
    }

    /**
     * @return ReferenceType
     */
    public function getReference()
    {
        return $this->Reference;
    }

    /**
     * @param ReferenceType $Reference
     *
     * @return SignedInfoType
     */
    public function setReference($Reference)
    {
        $this->Reference = $Reference;

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
     * @return SignedInfoType
     */
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }
}
