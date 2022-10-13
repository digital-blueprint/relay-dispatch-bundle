<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AdditionalFormat
{
    /**
     * @var base64Binary
     */
    protected $_ = null;

    /**
     * @var UNKNOWN
     */
    protected $Type = null;

    /**
     * @param base64Binary $_
     * @param UNKNOWN      $Type
     */
    public function __construct($_, $Type)
    {
        $this->_ = $_;
        $this->Type = $Type;
    }

    /**
     * @return base64Binary
     */
    public function get_()
    {
        return $this->_;
    }

    /**
     * @param base64Binary $_
     *
     * @return AdditionalFormat
     */
    public function set_($_)
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return UNKNOWN
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param UNKNOWN $Type
     *
     * @return AdditionalFormat
     */
    public function setType($Type)
    {
        $this->Type = $Type;

        return $this;
    }
}
