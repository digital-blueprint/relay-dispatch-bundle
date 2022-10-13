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
     * @var FamilyName
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

    /**
     * @param IdentificationType $Identification
     *
     * @return ForAttentionOf
     */
    public function setIdentification($Identification)
    {
        $this->Identification = $Identification;

        return $this;
    }

    /**
     * @return string
     */
    public function getDepartment()
    {
        return $this->Department;
    }

    /**
     * @param string $Department
     *
     * @return ForAttentionOf
     */
    public function setDepartment($Department)
    {
        $this->Department = $Department;

        return $this;
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
     * @return ForAttentionOf
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
     * @return ForAttentionOf
     */
    public function setFamilyName($FamilyName)
    {
        $this->FamilyName = $FamilyName;

        return $this;
    }
}
