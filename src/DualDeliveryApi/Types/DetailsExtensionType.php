<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DetailsExtensionType
{
    /**
     * @var DetailsExtensionType
     */
    protected $DetailsExtension = null;

    /**
     * @var CustomType
     */
    protected $Custom = null;

    /**
     * @param DetailsExtensionType $DetailsExtension
     * @param CustomType           $Custom
     */
    public function __construct($DetailsExtension, $Custom)
    {
        $this->DetailsExtension = $DetailsExtension;
        $this->Custom = $Custom;
    }

    /**
     * @return DetailsExtensionType
     */
    public function getDetailsExtension()
    {
        return $this->DetailsExtension;
    }

    /**
     * @param DetailsExtensionType $DetailsExtension
     *
     * @return DetailsExtensionType
     */
    public function setDetailsExtension($DetailsExtension)
    {
        $this->DetailsExtension = $DetailsExtension;

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
     * @return DetailsExtensionType
     */
    public function setCustom($Custom)
    {
        $this->Custom = $Custom;

        return $this;
    }
}
