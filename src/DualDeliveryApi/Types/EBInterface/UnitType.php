<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class UnitType
{
    /**
     * @var Decimal4Type
     */
    protected $_ = null;

    /**
     * @var string
     */
    protected $Unit = null;

    /**
     * @param Decimal4Type $_
     * @param string       $Unit
     */
    public function __construct($_, $Unit)
    {
        $this->_ = $_;
        $this->Unit = $Unit;
    }

    /**
     * @return Decimal4Type
     */
    public function get_()
    {
        return $this->_;
    }

    /**
     * @param Decimal4Type $_
     */
    public function set_($_): self
    {
        $this->_ = $_;

        return $this;
    }

    public function getUnit(): string
    {
        return $this->Unit;
    }

    public function setUnit(string $Unit): self
    {
        $this->Unit = $Unit;

        return $this;
    }
}
