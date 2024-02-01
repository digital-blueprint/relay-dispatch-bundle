<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class Affix
{
    /**
     * @var string
     */
    protected $_;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var ?string
     */
    protected $position;

    public function __construct(string $_, string $type, ?string $position)
    {
        $this->_ = $_;
        $this->type = $type;
        $this->position = $position;
    }

    public function get_(): string
    {
        return $this->_;
    }

    public function set_(string $_): void
    {
        $this->_ = $_;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }
}
