<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class BillerExtensionType
{
    /**
     * @var BillerExtensionType
     */
    protected $BillerExtension;

    /**
     * @var CustomType
     */
    protected $Custom;

    /**
     * @param BillerExtensionType $BillerExtension
     * @param CustomType          $Custom
     */
    public function __construct($BillerExtension, $Custom)
    {
        $this->BillerExtension = $BillerExtension;
        $this->Custom = $Custom;
    }

    public function getBillerExtension(): BillerExtensionType
    {
        return $this->BillerExtension;
    }

    public function setBillerExtension(BillerExtensionType $BillerExtension): self
    {
        $this->BillerExtension = $BillerExtension;

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
