<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class Value
{
    /**
     * @var string
     */
    protected $_;

    /**
     * @var string
     */
    protected $Id;

    public function __construct(string $_, ?string $Id)
    {
        $this->_ = $_;
        $this->Id = $Id;
    }

    public function get_(): string
    {
        return $this->_;
    }

    public function set_(string $_): void
    {
        $this->_ = $_;
    }

    public function getId(): ?string
    {
        return $this->Id;
    }

    public function setId(string $Id): void
    {
        $this->Id = $Id;
    }
}
