<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class Affix
{
    /**
     * @var string
     */
    protected $_ = null;

    /**
     * @var anonymous217
     */
    protected $type = null;

    /**
     * @var anonymous218
     */
    protected $position = null;

    /**
     * @param string       $_
     * @param anonymous217 $type
     * @param anonymous218 $position
     */
    public function __construct($_, $type, $position)
    {
        $this->_ = $_;
        $this->type = $type;
        $this->position = $position;
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
     * @return Affix
     */
    public function set_($_)
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return anonymous217
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param anonymous217 $type
     *
     * @return Affix
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return anonymous218
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param anonymous218 $position
     *
     * @return Affix
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
}
