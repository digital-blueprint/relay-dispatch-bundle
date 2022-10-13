<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PresentationDetailsExtensionType
{
    /**
     * @var PresentationDetailsExtensionType
     */
    protected $PresentationDetailsExtension = null;

    /**
     * @var CustomType
     */
    protected $Custom = null;

    /**
     * @param PresentationDetailsExtensionType $PresentationDetailsExtension
     * @param CustomType                       $Custom
     */
    public function __construct($PresentationDetailsExtension, $Custom)
    {
        $this->PresentationDetailsExtension = $PresentationDetailsExtension;
        $this->Custom = $Custom;
    }

    /**
     * @return PresentationDetailsExtensionType
     */
    public function getPresentationDetailsExtension()
    {
        return $this->PresentationDetailsExtension;
    }

    /**
     * @param PresentationDetailsExtensionType $PresentationDetailsExtension
     *
     * @return PresentationDetailsExtensionType
     */
    public function setPresentationDetailsExtension($PresentationDetailsExtension)
    {
        $this->PresentationDetailsExtension = $PresentationDetailsExtension;

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
     * @return PresentationDetailsExtensionType
     */
    public function setCustom($Custom)
    {
        $this->Custom = $Custom;

        return $this;
    }
}
