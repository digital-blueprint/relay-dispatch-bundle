<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class SenderType
{
    /**
     * @var SenderProfile
     */
    protected $SenderProfile;

    /**
     * @var ?SenderData
     */
    protected $SenderData;

    /**
     * @var ?ParametersType
     */
    protected $Parameters;

    public function __construct(SenderProfile $SenderProfile, SenderData $SenderData = null, ParametersType $Parameters = null)
    {
        $this->SenderProfile = $SenderProfile;
        $this->SenderData = $SenderData;
        $this->Parameters = $Parameters;
    }

    public function getSenderProfile(): SenderProfile
    {
        return $this->SenderProfile;
    }

    public function setSenderProfile(SenderProfile $SenderProfile): void
    {
        $this->SenderProfile = $SenderProfile;
    }

    public function getSenderData(): ?SenderData
    {
        return $this->SenderData;
    }

    public function setSenderData(SenderData $SenderData): void
    {
        $this->SenderData = $SenderData;
    }

    public function getParameters(): ?ParametersType
    {
        return $this->Parameters;
    }

    public function setParameters(ParametersType $Parameters): void
    {
        $this->Parameters = $Parameters;
    }
}
