<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

class EvidenceType
{
    /**
     * @var string
     */
    protected $AssertionIDReference;

    /**
     * @var AssertionType
     */
    protected $Assertion;

    /**
     * @param string        $AssertionIDReference
     * @param AssertionType $Assertion
     */
    public function __construct($AssertionIDReference, $Assertion)
    {
        $this->AssertionIDReference = $AssertionIDReference;
        $this->Assertion = $Assertion;
    }

    /**
     * @return string
     */
    public function getAssertionIDReference()
    {
        return $this->AssertionIDReference;
    }

    public function setAssertionIDReference(string $AssertionIDReference): self
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
