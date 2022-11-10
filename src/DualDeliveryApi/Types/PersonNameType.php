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

    /**
     * @param string $GivenName
     * @param string $FamilyName
     */
    public function __construct($GivenName, $FamilyName)
    {
        $this->GivenName = $GivenName;
        $this->FamilyName = $FamilyName;
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
