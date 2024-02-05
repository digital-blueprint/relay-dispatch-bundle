<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData;

class FamilyName
{
    /**
     * @var string
     */
    protected $_;

    /**
     * true, false, or undefined (default).
     *
     * @var ?string
     */
    protected $primary;

    /**
     * @var ?string
     */
    protected $prefix;

    public function __construct($_, ?string $primary = null, ?string $prefix = null)
    {
        $this->_ = $_;
        $this->primary = $primary;
        if ($primary !== null) {
            $this->setPrimary($primary);
        }
        $this->prefix = $prefix;
    }

    public function get_(): string
    {
        return $this->_;
    }

    public function set_(string $_): void
    {
        $this->_ = $_;
    }

    public function getPrimary(): ?string
    {
        return $this->primary;
    }

    public function setPrimary(string $primary): void
    {
        assert(in_array($primary, ['true', 'false', 'undefined'], true));
        $this->primary = $primary;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }
}
