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

    /**
     * @return string
     */
    public function getGivenName()
    {
        return $this->GivenName;
    }

    /**
     * @param string $GivenName
     *
     * @return PersonNameType
     */
    public function setGivenName($GivenName)
    {
        $this->GivenName = $GivenName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFamilyName()
    {
        return $this->FamilyName;
    }

    /**
     * @param string $FamilyName
     *
     * @return PersonNameType
     */
    public function setFamilyName($FamilyName)
    {
        $this->FamilyName = $FamilyName;

        return $this;
    }
}
