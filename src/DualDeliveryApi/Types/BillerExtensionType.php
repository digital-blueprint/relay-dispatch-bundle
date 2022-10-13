<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class BillerExtensionType
{
    /**
     * @var BillerExtensionType
     */
    protected $BillerExtension = null;

    /**
     * @var CustomType
     */
    protected $Custom = null;

    /**
     * @param BillerExtensionType $BillerExtension
     * @param CustomType          $Custom
     */
    public function __construct($BillerExtension, $Custom)
    {
        $this->BillerExtension = $BillerExtension;
        $this->Custom = $Custom;
    }

    /**
     * @return BillerExtensionType
     */
    public function getBillerExtension()
    {
        return $this->BillerExtension;
    }

    /**
     * @param BillerExtensionType $BillerExtension
     *
     * @return BillerExtensionType
     */
    public function setBillerExtension($BillerExtension)
    {
        $this->BillerExtension = $BillerExtension;

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
     * @return BillerExtensionType
     */
    public function setCustom($Custom)
    {
        $this->Custom = $Custom;

        return $this;
    }
}
