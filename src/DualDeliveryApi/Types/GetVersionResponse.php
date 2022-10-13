<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class GetVersionResponse
{
    /**
     * @var versionNumberType
     */
    protected $Version = null;

    /**
     * @param versionNumberType $Version
     */
    public function __construct($Version)
    {
        $this->Version = $Version;
    }

    /**
     * @return versionNumberType
     */
    public function getVersion()
    {
        return $this->Version;
    }

    /**
     * @param versionNumberType $Version
     *
     * @return GetVersionResponse
     */
    public function setVersion($Version)
    {
        $this->Version = $Version;

        return $this;
    }
}
