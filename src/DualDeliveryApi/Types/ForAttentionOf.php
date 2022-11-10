<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ForAttentionOf
{
    /**
     * @var stringentificationType
     */
    protected $Identification = null;

    /**
     * @var string
     */
    protected $Department = null;

    /**
     * @var string
     */
    protected $GivenName = null;

    /**
     * @var string
     */
    protected $FamilyName = null;

    /**
     * @param IdentificationType $Identification
     * @param string             $Department
     * @param string             $GivenName
     * @param FamilyName         $FamilyName
     */
    public function __construct($Identification, $Department, $GivenName, $FamilyName)
    {
        $this->Identification = $Identification;
        $this->Department = $Department;
        $this->GivenName = $GivenName;
        $this->FamilyName = $FamilyName;
    }

    /**
     * @return stringentificationType
     */
    public function getIdentification()
    {
        return $this->Identification;
    }

    public function setIdentification(IdentificationType $Identification): self
    {
        $this->Identification = $Identification;

        return $this;
    }

    public function getDepartment(): string
    {
        return $this->Department;
    }

    public function setDepartment(string $Department): self
    {
        $this->Department = $Department;

        return $this;
    }

    public function getGivenName(): string
    {
        return $this->GivenName;
    }

    public function setGivenName(string $GivenName): self
    {
        $this->GivenName = $GivenName;

        return $this;
    }

    public function getFamilyName(): string
    {
        return $this->FamilyName;
    }

    public function setFamilyName(string $FamilyName): self
    {
        $this->FamilyName = $FamilyName;

        return $this;
    }
}
