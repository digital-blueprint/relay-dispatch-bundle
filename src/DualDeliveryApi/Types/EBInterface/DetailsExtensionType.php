<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class DetailsExtensionType
{
    /**
     * @var DetailsExtensionType
     */
    protected $DetailsExtension;

    /**
     * @var CustomType
     */
    protected $Custom;

    /**
     * @param DetailsExtensionType $DetailsExtension
     * @param CustomType           $Custom
     */
    public function __construct($DetailsExtension, $Custom)
    {
        $this->DetailsExtension = $DetailsExtension;
        $this->Custom = $Custom;
    }

    public function getDetailsExtension(): DetailsExtensionType
    {
        return $this->DetailsExtension;
    }

    public function setDetailsExtension(DetailsExtensionType $DetailsExtension): self
    {
        $this->DetailsExtension = $DetailsExtension;

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
