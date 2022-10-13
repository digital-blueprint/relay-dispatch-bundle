<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class Sender
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
     * @param SenderProfile  $SenderProfile
     * @param SenderData     $SenderData
     * @param ParametersType $Parameters
     */
    public function __construct($SenderProfile, $SenderData, $Parameters)
    {
        $this->SenderProfile = $SenderProfile;
        $this->SenderData = $SenderData;
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
     * @return Sender
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
     * @return Sender
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
     * @return Sender
     */
    public function setParameters($Parameters)
    {
        $this->Parameters = $Parameters;

        return $this;
    }
}
