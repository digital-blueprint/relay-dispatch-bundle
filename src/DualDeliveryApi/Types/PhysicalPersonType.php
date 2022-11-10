<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PhysicalPersonType extends AbstractPersonType
{
    /**
     * @var PersonNameType
     */
    protected $Name = null;

    /**
     * @var string
     */
    protected $DateOfBirth = null;

    /**
     * @param PersonNameType $Name
     * @param string         $DateOfBirth
     */
    public function __construct($Name, $DateOfBirth)
    {
        parent::__construct();
        $this->Name = $Name;
        $this->DateOfBirth = $DateOfBirth;
    }

    public function getName(): PersonNameType
    {
        return $this->Name;
    }

    public function setName(PersonNameType $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDateOfBirth(): string
    {
        return $this->DateOfBirth;
    }

    public function setDateOfBirth(string $DateOfBirth): self
    {
        $this->DateOfBirth = $DateOfBirth;

        return $this;
    }
}
