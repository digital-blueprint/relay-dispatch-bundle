<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class EvidenceType
{
    /**
     * @var stringReferenceType
     */
    protected $AssertionIDReference = null;

    /**
     * @var AssertionType
     */
    protected $Assertion = null;

    /**
     * @param IDReferenceType $AssertionIDReference
     * @param AssertionType   $Assertion
     */
    public function __construct($AssertionIDReference, $Assertion)
    {
        $this->AssertionIDReference = $AssertionIDReference;
        $this->Assertion = $Assertion;
    }

    /**
     * @return stringReferenceType
     */
    public function getAssertionIDReference()
    {
        return $this->AssertionIDReference;
    }

    /**
     * @param IDReferenceType $AssertionIDReference
     *
     * @return EvidenceType
     */
    public function setAssertionIDReference($AssertionIDReference)
    {
        $this->AssertionIDReference = $AssertionIDReference;

        return $this;
    }

    /**
     * @return AssertionType
     */
    public function getAssertion()
    {
        return $this->Assertion;
    }

    /**
     * @param AssertionType $Assertion
     *
     * @return EvidenceType
     */
    public function setAssertion($Assertion)
    {
        $this->Assertion = $Assertion;

        return $this;
    }
}
