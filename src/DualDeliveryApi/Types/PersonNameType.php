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
     * @var FamilyName
     */
    protected $FamilyName = null;

    /**
     * @var Affix
     */
    protected $Affix = null;

    /**
     * @param string     $GivenName
     * @param FamilyName $FamilyName
     * @param Affix      $Affix
     */
    public function __construct($GivenName, $FamilyName, $Affix)
    {
        $this->GivenName = $GivenName;
        $this->FamilyName = $FamilyName;
        $this->Affix = $Affix;
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
     * @return FamilyName
     */
    public function getFamilyName()
    {
        return $this->FamilyName;
    }

    /**
     * @param FamilyName $FamilyName
     *
     * @return PersonNameType
     */
    public function setFamilyName($FamilyName)
    {
        $this->FamilyName = $FamilyName;

        return $this;
    }

    /**
     * @return Affix
     */
    public function getAffix()
    {
        return $this->Affix;
    }

    /**
     * @param Affix $Affix
     *
     * @return PersonNameType
     */
    public function setAffix($Affix)
    {
        $this->Affix = $Affix;

        return $this;
    }
}
