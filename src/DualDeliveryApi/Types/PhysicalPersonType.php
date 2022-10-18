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

    /**
     * @return PersonNameType
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param PersonNameType $Name
     *
     * @return PhysicalPersonType
     */
    public function setName($Name)
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDateOfBirth()
    {
        return $this->DateOfBirth;
    }

    /**
     * @param string $DateOfBirth
     *
     * @return PhysicalPersonType
     */
    public function setDateOfBirth($DateOfBirth)
    {
        $this->DateOfBirth = $DateOfBirth;

        return $this;
    }
}
