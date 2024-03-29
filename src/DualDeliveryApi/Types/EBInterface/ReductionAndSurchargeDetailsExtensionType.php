<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class ReductionAndSurchargeDetailsExtensionType
{
    /**
     * @var ReductionAndSurchargeDetailsExtensionType
     */
    protected $ReductionAndSurchargeDetailsExtension;

    /**
     * @var CustomType
     */
    protected $Custom;

    /**
     * @param ReductionAndSurchargeDetailsExtensionType $ReductionAndSurchargeDetailsExtension
     * @param CustomType                                $Custom
     */
    public function __construct($ReductionAndSurchargeDetailsExtension, $Custom)
    {
        $this->ReductionAndSurchargeDetailsExtension = $ReductionAndSurchargeDetailsExtension;
        $this->Custom = $Custom;
    }

    public function getReductionAndSurchargeDetailsExtension(): ReductionAndSurchargeDetailsExtensionType
    {
        return $this->ReductionAndSurchargeDetailsExtension;
    }

    public function setReductionAndSurchargeDetailsExtension(ReductionAndSurchargeDetailsExtensionType $ReductionAndSurchargeDetailsExtension): self
    {
        $this->ReductionAndSurchargeDetailsExtension = $ReductionAndSurchargeDetailsExtension;

        return $this;
    }

    public function getCustom(): CustomType
    {
        return $this->Custom;
    }

    public function setCustom(CustomType $Custom): self
    {
        $this->Custom = $Custom;

        return $this;
    }
}
