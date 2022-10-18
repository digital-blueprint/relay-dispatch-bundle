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

    /**
     * @return AbstractPersonType
     */
    public function getPerson()
    {
        return $this->Person;
    }

    /**
     * @param AbstractPersonType $Person
     *
     * @return PersonDataType
     */
    public function setPerson($Person)
    {
        $this->Person = $Person;

        return $this;
    }

    /**
     * @return AbstractAddressType
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * @param AbstractAddressType $Address
     *
     * @return PersonDataType
     */
    public function setAddress($Address)
    {
        $this->Address = $Address;

        return $this;
    }
}
