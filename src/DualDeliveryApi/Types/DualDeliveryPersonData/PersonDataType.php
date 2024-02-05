<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData;

class PersonDataType
{
    /**
     * @var AbstractPersonType
     */
    protected $Person;

    /**
     * @var ?AbstractAddressType
     */
    protected $Address;

    public function __construct(AbstractPersonType $Person, ?AbstractAddressType $Address = null)
    {
        $this->Person = $Person;
        $this->Address = $Address;
    }

    public function getPerson(): AbstractPersonType
    {
        return $this->Person;
    }

    public function setPerson(AbstractPersonType $Person): void
    {
        $this->Person = $Person;
    }

    public function getAddress(): ?AbstractAddressType
    {
        return $this->Address;
    }

    public function setAddress(AbstractAddressType $Address): void
    {
        $this->Address = $Address;
    }
}
