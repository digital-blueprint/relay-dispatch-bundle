<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class Affix
{
    /**
     * @var string
     */
    protected $_ = null;

    /**
     * @var string
     */
    protected $type = null;

    /**
     * @var string
     */
    protected $position = null;

    public function __construct(string $_, string $type, string $position)
    {
        $this->_ = $_;
        $this->type = $type;
        $this->position = $position;
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

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }
}
