<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData;

class ForAttentionOf
{
    /**
     * @var ?IdentificationType
     */
    protected $Identification;

    /**
     * @var ?string
     */
    protected $Department;

    /**
     * @var ?string
     */
    protected $GivenName;

    /**
     * @var ?FamilyName
     */
    protected $FamilyName;

    public function __construct(?IdentificationType $Identification, ?string $Department, ?string $GivenName, ?FamilyName $FamilyName)
    {
        $this->Identification = $Identification;
        $this->Department = $Department;
        $this->GivenName = $GivenName;
        $this->FamilyName = $FamilyName;
    }

    public function getIdentification(): ?IdentificationType
    {
        return $this->Identification;
    }

    public function setIdentification(IdentificationType $Identification): void
    {
        $this->Identification = $Identification;
    }

    public function getDepartment(): ?string
    {
        return $this->Department;
    }

    public function setDepartment(string $Department): void
    {
        $this->Department = $Department;
    }

    public function getGivenName(): ?string
    {
        return $this->GivenName;
    }

    public function setGivenName(string $GivenName): void
    {
        $this->GivenName = $GivenName;
    }

    public function getFamilyName(): ?FamilyName
    {
        return $this->FamilyName;
    }

    public function setFamilyName(FamilyName $FamilyName): void
    {
        $this->FamilyName = $FamilyName;
    }
}
