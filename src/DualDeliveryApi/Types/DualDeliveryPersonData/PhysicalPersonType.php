<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData;

class PhysicalPersonType extends AbstractPersonType
{
    /**
     * @var PersonNameType
     */
    protected $Name;

    /**
     * @var ?string
     */
    protected $DateOfBirth;

    public function __construct(PersonNameType $Name, string $DateOfBirth = null)
    {
        parent::__construct();
        $this->Name = $Name;
        $this->DateOfBirth = $DateOfBirth;
    }

    public function getName(): PersonNameType
    {
        return $this->Name;
    }

    public function setName(PersonNameType $Name): void
    {
        $this->Name = $Name;
    }

    public function getDateOfBirth(): ?string
    {
        return $this->DateOfBirth;
    }

    public function setDateOfBirth(string $DateOfBirth): void
    {
        $this->DateOfBirth = $DateOfBirth;
    }
}
