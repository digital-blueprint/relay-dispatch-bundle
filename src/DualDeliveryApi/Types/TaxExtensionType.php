<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class TaxExtensionType
{
    /**
     * @var TaxExtensionType
     */
    protected $TaxExtension = null;

    /**
     * @var CustomType
     */
    protected $Custom = null;

    /**
     * @param TaxExtensionType $TaxExtension
     * @param CustomType       $Custom
     */
    public function __construct($TaxExtension, $Custom)
    {
        $this->TaxExtension = $TaxExtension;
        $this->Custom = $Custom;
    }

    /**
     * @return TaxExtensionType
     */
    public function getTaxExtension()
    {
        return $this->TaxExtension;
    }

    /**
     * @param TaxExtensionType $TaxExtension
     *
     * @return TaxExtensionType
     */
    public function setTaxExtension($TaxExtension)
    {
        $this->TaxExtension = $TaxExtension;

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
     * @return TaxExtensionType
     */
    public function setCustom($Custom)
    {
        $this->Custom = $Custom;

        return $this;
    }
}
