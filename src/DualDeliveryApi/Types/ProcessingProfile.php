<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ProcessingProfile
{
    /**
     * @var string
     */
    protected $_ = null;

    /**
     * @var string
     */
    protected $version = null;

    public function __construct(string $_, string $version)
    {
        $this->_ = $_;
        $this->version = $version;
    }

    public function get_(): string
    {
        return $this->_;
    }

    public function set_(string $_): self
    {
        $this->_ = $_;

        return $this;
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
