<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @param IDReferenceType $AssertionIDReference
     *
     * @return AdviceType
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
     * @return AdviceType
     */
    public function setAssertion($Assertion)
    {
        $this->Assertion = $Assertion;

        return $this;
    }

    /**
     * @return string
     */
    public function getAny()
    {
        return $this->any;
    }

    /**
     * @param string $any
     *
     * @return AdviceType
     */
    public function setAny($any)
    {
        $this->any = $any;

        return $this;
    }
}
