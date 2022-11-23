<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class ForAttentionOf
{
    /**
     * @var ?IdentificationType
     */
    protected $Identification = null;

    /**
     * @var ?string
     */
    protected $Department = null;

    /**
     * @var ?string
     */
    protected $GivenName = null;

    /**
     * @var ?string
     */
    protected $FamilyName = null;

    public function __construct(?IdentificationType $Identification, ?string $Department, ?string $GivenName, ?string $FamilyName)
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

    public function getFamilyName(): ?string
    {
        return $this->FamilyName;
    }

    public function setFamilyName(string $FamilyName): void
    {
        $this->FamilyName = $FamilyName;
    }
}
