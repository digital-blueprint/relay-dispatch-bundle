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

    public function getSenderProfile(): SenderProfile
    {
        return $this->SenderProfile;
    }

    public function setSenderProfile(SenderProfile $SenderProfile): self
    {
        $this->SenderProfile = $SenderProfile;

        return $this;
    }

    public function getSenderData(): SenderData
    {
        return $this->SenderData;
    }

    public function setSenderData(SenderData $SenderData): self
    {
        $this->SenderData = $SenderData;

        return $this;
    }

    public function getParameters(): ParametersType
    {
        return $this->Parameters;
    }

    public function setParameters(ParametersType $Parameters): self
    {
        $this->Parameters = $Parameters;

        return $this;
    }
}
