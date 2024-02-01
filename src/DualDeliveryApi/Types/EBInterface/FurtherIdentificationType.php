<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class FurtherIdentificationType
{
    /**
     * @var AlphaNumIDType
     */
    protected $_;

    /**
     * @var string
     */
    protected $IdentificationType;

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
     */
    public function set_($_): self
    {
        $this->_ = $_;

        return $this;
    }

    public function getIdentificationType(): string
    {
        return $this->IdentificationType;
    }

    public function setIdentificationType(string $IdentificationType): self
    {
        $this->IdentificationType = $IdentificationType;

        return $this;
    }
}
