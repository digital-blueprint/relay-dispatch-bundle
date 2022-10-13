<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ApplicationID
{
    /**
     * @var string
     */
    protected $_ = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @param string $_
     * @param string $version
     */
    public function __construct($_, $version)
    {
        $this->_ = $_;
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function get_()
    {
        return $this->_;
    }

    /**
     * @param string $_
     *
     * @return ApplicationID
     */
    public function set_($_)
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return ApplicationID
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
