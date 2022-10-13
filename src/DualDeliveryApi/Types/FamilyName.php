<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class FamilyName
{
    /**
     * @var string
     */
    protected $_ = null;

    /**
     * @var anonymous215
     */
    protected $primary = null;

    /**
     * @var string
     */
    protected $prefix = null;

    /**
     * @param string       $_
     * @param anonymous215 $primary
     * @param string       $prefix
     */
    public function __construct($_, $primary, $prefix)
    {
        $this->_ = $_;
        $this->primary = $primary;
        $this->prefix = $prefix;
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
     * @return FamilyName
     */
    public function set_($_)
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return anonymous215
     */
    public function getPrimary()
    {
        return $this->primary;
    }

    /**
     * @param anonymous215 $primary
     *
     * @return FamilyName
     */
    public function setPrimary($primary)
    {
        $this->primary = $primary;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     *
     * @return FamilyName
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }
}
