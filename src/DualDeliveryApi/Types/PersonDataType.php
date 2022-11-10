<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PersonDataType
{
    /**
     * @var AbstractPersonType
     */
    protected $Person = null;

    /**
     * @var AbstractAddressType
     */
    protected $Address = null;

    /**
     * @param AbstractPersonType  $Person
     * @param AbstractAddressType $Address
     */
    public function __construct($Person, $Address = null)
    {
        $this->Person = $Person;
        $this->Address = $Address;
    }

    public function getPerson(): AbstractPersonType
    {
        return $this->Person;
    }

    public function setPerson(AbstractPersonType $Person): self
    {
        $this->Person = $Person;

        return $this;
    }

    public function getAddress(): AbstractAddressType
    {
        return $this->Address;
    }

    public function setAddress(AbstractAddressType $Address): self
    {
        $this->Address = $Address;

        return $this;
    }
}
