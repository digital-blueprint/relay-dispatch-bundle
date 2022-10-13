<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class Value
{
    /**
     * @var string
     */
    protected $_ = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param string $_
     * @param string $Id
     */
    public function __construct($_, $Id)
    {
        $this->_ = $_;
        $this->Id = $Id;
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
     * @return Value
     */
    public function set_($_)
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param string $Id
     *
     * @return Value
     */
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }
}
