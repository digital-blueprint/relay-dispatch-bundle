<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AccountType
{
    /**
     * @var BankNameType
     */
    protected $BankName = null;

    /**
     * @var BankCodeCType
     */
    protected $BankCode = null;

    /**
     * @var BICType
     */
    protected $BIC = null;

    /**
     * @var string
     */
    protected $BankAccountNr = null;

    /**
     * @var IBANType
     */
    protected $IBAN = null;

    /**
     * @var BankAccountOwnerType
     */
    protected $BankAccountOwner = null;

    /**
     * @param BankNameType         $BankName
     * @param BankCodeCType        $BankCode
     * @param BICType              $BIC
     * @param string               $BankAccountNr
     * @param IBANType             $IBAN
     * @param BankAccountOwnerType $BankAccountOwner
     */
    public function __construct($BankName, $BankCode, $BIC, $BankAccountNr, $IBAN, $BankAccountOwner)
    {
        $this->BankName = $BankName;
        $this->BankCode = $BankCode;
        $this->BIC = $BIC;
        $this->BankAccountNr = $BankAccountNr;
        $this->IBAN = $IBAN;
        $this->BankAccountOwner = $BankAccountOwner;
    }

    /**
     * @return BankNameType
     */
    public function getBankName()
    {
        return $this->BankName;
    }

    /**
     * @param BankNameType $BankName
     *
     * @return AccountType
     */
    public function setBankName($BankName)
    {
        $this->BankName = $BankName;

        return $this;
    }

    /**
     * @return BankCodeCType
     */
    public function getBankCode()
    {
        return $this->BankCode;
    }

    /**
     * @param BankCodeCType $BankCode
     *
     * @return AccountType
     */
    public function setBankCode($BankCode)
    {
        $this->BankCode = $BankCode;

        return $this;
    }

    /**
     * @return BICType
     */
    public function getBIC()
    {
        return $this->BIC;
    }

    /**
     * @param BICType $BIC
     *
     * @return AccountType
     */
    public function setBIC($BIC)
    {
        $this->BIC = $BIC;

        return $this;
    }

    /**
     * @return string
     */
    public function getBankAccountNr()
    {
        return $this->BankAccountNr;
    }

    /**
     * @param string $BankAccountNr
     *
     * @return AccountType
     */
    public function setBankAccountNr($BankAccountNr)
    {
        $this->BankAccountNr = $BankAccountNr;

        return $this;
    }

    /**
     * @return IBANType
     */
    public function getIBAN()
    {
        return $this->IBAN;
    }

    /**
     * @param IBANType $IBAN
     *
     * @return AccountType
     */
    public function setIBAN($IBAN)
    {
        $this->IBAN = $IBAN;

        return $this;
    }

    /**
     * @return BankAccountOwnerType
     */
    public function getBankAccountOwner()
    {
        return $this->BankAccountOwner;
    }

    /**
     * @param BankAccountOwnerType $BankAccountOwner
     *
     * @return AccountType
     */
    public function setBankAccountOwner($BankAccountOwner)
    {
        $this->BankAccountOwner = $BankAccountOwner;

        return $this;
    }
}
