<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\IDReferenceType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\stringReferenceType;

class AdviceType
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
     * @var string
     */
    protected $any = null;

    /**
     * @param IDReferenceType $AssertionIDReference
     * @param AssertionType   $Assertion
     * @param string          $any
     */
    public function __construct($AssertionIDReference, $Assertion, $any)
    {
        $this->AssertionIDReference = $AssertionIDReference;
        $this->Assertion = $Assertion;
        $this->any = $any;
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

    public function getAny(): string
    {
        return $this->any;
    }

    public function setAny(string $any): self
    {
        $this->any = $any;

        return $this;
    }
}
