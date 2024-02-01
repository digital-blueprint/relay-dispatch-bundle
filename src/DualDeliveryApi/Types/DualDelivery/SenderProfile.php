<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class SenderProfile
{
    /**
     * @var string
     */
    protected $_;

    /**
     * @var string
     */
    protected $version;

    public function __construct(string $_, string $version)
    {
        $this->_ = $_;
        $this->version = $version;
    }

    public function get_(): string
    {
        return $this->_;
    }

    public function set_(string $_): void
    {
        $this->_ = $_;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }
}
