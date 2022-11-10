<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class BankCodeCType
{
    /**
     * @var int
     */
    protected $_ = null;

    /**
     * @var CountryCodeType
     */
    protected $BankCodeType = null;

    /**
     * @param int             $_
     * @param CountryCodeType $BankCodeType
     */
    public function __construct($_, $BankCodeType)
    {
        $this->_ = $_;
        $this->BankCodeType = $BankCodeType;
    }

    public function get_(): int
    {
        return $this->_;
    }

    public function set_(int $_): self
    {
        $this->_ = $_;

        return $this;
    }

    public function getBankCodeType(): CountryCodeType
    {
        return $this->BankCodeType;
    }

    public function setBankCodeType(CountryCodeType $BankCodeType): self
    {
        $this->BankCodeType = $BankCodeType;

        return $this;
    }
}
