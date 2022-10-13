<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class SenderType extends PersonDataType
{
    /**
     * @var SenderProfile
     */
    protected $SenderProfile = null;

    /**
     * @var SenderData
     */
    protected $SenderData = null;

    /**
     * @var ParametersType
     */
    protected $Parameters = null;

    /**
     * @param AbstractPersonType  $Person
     * @param AbstractAddressType $Address
     * @param SenderProfile       $SenderProfile
     * @param ParametersType      $Parameters
     */
    public function __construct($Person, $Address, $SenderProfile, $Parameters)
    {
        parent::__construct($Person, $Address);
        $this->SenderProfile = $SenderProfile;
        $this->Parameters = $Parameters;
    }

    /**
     * @return SenderProfile
     */
    public function getSenderProfile()
    {
        return $this->SenderProfile;
    }

    /**
     * @param SenderProfile $SenderProfile
     *
     * @return SenderType
     */
    public function setSenderProfile($SenderProfile)
    {
        $this->SenderProfile = $SenderProfile;

        return $this;
    }

    /**
     * @return SenderData
     */
    public function getSenderData()
    {
        return $this->SenderData;
    }

    /**
     * @param SenderData $SenderData
     *
     * @return SenderType
     */
    public function setSenderData($SenderData)
    {
        $this->SenderData = $SenderData;

        return $this;
    }

    /**
     * @return ParametersType
     */
    public function getParameters()
    {
        return $this->Parameters;
    }

    /**
     * @param ParametersType $Parameters
     *
     * @return SenderType
     */
    public function setParameters($Parameters)
    {
        $this->Parameters = $Parameters;

        return $this;
    }
}
