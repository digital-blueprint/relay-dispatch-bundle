<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class FurtherIdentificationType
{
    /**
     * @var AlphaNumIDType
     */
    protected $_ = null;

    /**
     * @var string
     */
    protected $IdentificationType = null;

    /**
     * @param AlphaNumIDType $_
     * @param string         $IdentificationType
     */
    public function __construct($_, $IdentificationType)
    {
        $this->_ = $_;
        $this->IdentificationType = $IdentificationType;
    }

    /**
     * @return AlphaNumIDType
     */
    public function get_()
    {
        return $this->_;
    }

    /**
     * @param AlphaNumIDType $_
     *
     * @return FurtherIdentificationType
     */
    public function set_($_)
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdentificationType()
    {
        return $this->IdentificationType;
    }

    /**
     * @param string $IdentificationType
     *
     * @return FurtherIdentificationType
     */
    public function setIdentificationType($IdentificationType)
    {
        $this->IdentificationType = $IdentificationType;

        return $this;
    }
}
