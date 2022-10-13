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

    /**
     * @return int
     */
    public function get_()
    {
        return $this->_;
    }

    /**
     * @param int $_
     *
     * @return BankCodeCType
     */
    public function set_($_)
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return CountryCodeType
     */
    public function getBankCodeType()
    {
        return $this->BankCodeType;
    }

    /**
     * @param CountryCodeType $BankCodeType
     *
     * @return BankCodeCType
     */
    public function setBankCodeType($BankCodeType)
    {
        $this->BankCodeType = $BankCodeType;

        return $this;
    }
}
