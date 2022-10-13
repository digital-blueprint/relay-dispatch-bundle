<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ReductionAndSurchargeDetailsExtensionType
{
    /**
     * @var ReductionAndSurchargeDetailsExtensionType
     */
    protected $ReductionAndSurchargeDetailsExtension = null;

    /**
     * @var CustomType
     */
    protected $Custom = null;

    /**
     * @param ReductionAndSurchargeDetailsExtensionType $ReductionAndSurchargeDetailsExtension
     * @param CustomType                                $Custom
     */
    public function __construct($ReductionAndSurchargeDetailsExtension, $Custom)
    {
        $this->ReductionAndSurchargeDetailsExtension = $ReductionAndSurchargeDetailsExtension;
        $this->Custom = $Custom;
    }

    /**
     * @return ReductionAndSurchargeDetailsExtensionType
     */
    public function getReductionAndSurchargeDetailsExtension()
    {
        return $this->ReductionAndSurchargeDetailsExtension;
    }

    /**
     * @param ReductionAndSurchargeDetailsExtensionType $ReductionAndSurchargeDetailsExtension
     *
     * @return ReductionAndSurchargeDetailsExtensionType
     */
    public function setReductionAndSurchargeDetailsExtension($ReductionAndSurchargeDetailsExtension)
    {
        $this->ReductionAndSurchargeDetailsExtension = $ReductionAndSurchargeDetailsExtension;

        return $this;
    }

    /**
     * @return CustomType
     */
    public function getCustom()
    {
        return $this->Custom;
    }

    /**
     * @param CustomType $Custom
     *
     * @return ReductionAndSurchargeDetailsExtensionType
     */
    public function setCustom($Custom)
    {
        $this->Custom = $Custom;

        return $this;
    }
}
