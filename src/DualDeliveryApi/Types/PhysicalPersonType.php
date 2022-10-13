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
     * @var DateOfBirthType
     */
    protected $DateOfBirth = null;

    /**
     * @param string          $AbstractSimpleIdentification
     * @param string          $Id
     * @param PersonNameType  $Name
     * @param DateOfBirthType $DateOfBirth
     */
    public function __construct($AbstractSimpleIdentification, $Id, $Name, $DateOfBirth)
    {
        parent::__construct($AbstractSimpleIdentification, $Id);
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
     * @return DateOfBirthType
     */
    public function getDateOfBirth()
    {
        return $this->DateOfBirth;
    }

    /**
     * @param DateOfBirthType $DateOfBirth
     *
     * @return PhysicalPersonType
     */
    public function setDateOfBirth($DateOfBirth)
    {
        $this->DateOfBirth = $DateOfBirth;

        return $this;
    }
}
