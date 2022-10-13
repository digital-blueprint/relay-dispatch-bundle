<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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
     *
     * @return UnitType
     */
    public function set_($_)
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->Unit;
    }

    /**
     * @param string $Unit
     *
     * @return UnitType
     */
    public function setUnit($Unit)
    {
        $this->Unit = $Unit;

        return $this;
    }
}
