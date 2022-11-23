<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\IDReferenceType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\stringReferenceType;

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

    public function setAssertionIDReference(IDReferenceType $AssertionIDReference): self
    {
        $this->AssertionIDReference = $AssertionIDReference;

        return $this;
    }

    public function getAssertion(): AssertionType
    {
        return $this->Assertion;
    }

    public function setAssertion(AssertionType $Assertion): self
    {
        $this->Assertion = $Assertion;

        return $this;
    }
}
