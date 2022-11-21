<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PersonNameType
{
    /**
     * @var string
     */
    protected $GivenName = null;

    /**
     * @var string
     */
    protected $FamilyName = null;

    public function __construct(string $GivenName, string $FamilyName)
    {
        $this->GivenName = $GivenName;
        $this->FamilyName = $FamilyName;
    }

    public function getGivenName(): string
    {
        return $this->GivenName;
    }

    public function setGivenName(string $GivenName): void
    {
        $this->GivenName = $GivenName;
    }

    public function getFamilyName(): string
    {
        return $this->FamilyName;
    }

    public function setFamilyName(string $FamilyName): void
    {
        $this->FamilyName = $FamilyName;
    }
}
