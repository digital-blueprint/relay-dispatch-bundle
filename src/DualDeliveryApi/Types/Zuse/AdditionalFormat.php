<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class AdditionalFormat
{
    /**
     * @var string
     */
    protected $_ = null;

    /**
     * @var string
     */
    protected $Type = null;

    public function __construct(string $_, string $Type)
    {
        $this->_ = $_;
        $this->Type = $Type;
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
        return $this->Type;
    }

    public function setType(string $Type): void
    {
        $this->Type = $Type;
    }
}
