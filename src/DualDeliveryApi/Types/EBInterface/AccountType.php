<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class AccountType
{
    /**
     * @var BankNameType
     */
    protected $BankName;

    /**
     * @var BankCodeCType
     */
    protected $BankCode;

    /**
     * @var BICType
     */
    protected $BIC;

    /**
     * @var string
     */
    protected $BankAccountNr;

    /**
     * @var IBANType
     */
    protected $IBAN;

    /**
     * @var BankAccountOwnerType
     */
    protected $BankAccountOwner;

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
     */
    public function setBankName($BankName): self
    {
        $this->BankName = $BankName;

        return $this;
    }

    public function getBankCode(): BankCodeCType
    {
        return $this->BankCode;
    }

    public function setBankCode(BankCodeCType $BankCode): self
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
     */
    public function setBIC($BIC): self
    {
        $this->BIC = $BIC;

        return $this;
    }

    public function getBankAccountNr(): string
    {
        return $this->BankAccountNr;
    }

    public function setBankAccountNr(string $BankAccountNr): self
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
     */
    public function setIBAN($IBAN): self
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
     */
    public function setBankAccountOwner($BankAccountOwner): self
    {
        $this->BankAccountOwner = $BankAccountOwner;

        return $this;
    }
}
