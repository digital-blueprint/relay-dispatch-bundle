<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryBulk;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ParametersType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\SenderData;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\SenderProfile;

class Sender
{
    /**
     * @var SenderProfile
     */
    protected $SenderProfile = null;

    /**
     * @var ?SenderData
     */
    protected $SenderData = null;

    /**
     * @var ?ParametersType
     */
    protected $Parameters = null;

    public function __construct(SenderProfile $SenderProfile, ?SenderData $SenderData, ?ParametersType $Parameters)
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
