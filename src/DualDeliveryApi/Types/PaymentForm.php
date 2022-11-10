<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PaymentForm
{
    /**
     * @var Receiver
     */
    protected $Receiver = null;

    /**
     * @var ReceiverBank
     */
    protected $ReceiverBank = null;

    /**
     * @var Amount
     */
    protected $Amount = null;

    /**
     * @var Purpose
     */
    protected $Purpose = null;

    /**
     * @var string
     */
    protected $CustomerData = null;

    /**
     * @var ReadingArea
     */
    protected $ReadingArea = null;

    /**
     * @var Currency
     */
    protected $Currency = null;

    /**
     * @var AccountInfo
     */
    protected $AccountInfo = null;

    /**
     * @var \DateTime
     */
    protected $DueDate = null;

    /**
     * @var bool
     */
    protected $DirectDebit = null;

    /**
     * @var ParameterSet
     */
    protected $ParameterSet = null;

    /**
     * @param Receiver     $Receiver
     * @param ReceiverBank $ReceiverBank
     * @param Amount       $Amount
     * @param Purpose      $Purpose
     * @param string       $CustomerData
     * @param ReadingArea  $ReadingArea
     * @param Currency     $Currency
     * @param AccountInfo  $AccountInfo
     * @param bool         $DirectDebit
     * @param ParameterSet $ParameterSet
     */
    public function __construct($Receiver, $ReceiverBank, $Amount, $Purpose, $CustomerData, $ReadingArea, $Currency, $AccountInfo, \DateTime $DueDate, $DirectDebit, $ParameterSet)
    {
        $this->Receiver = $Receiver;
        $this->ReceiverBank = $ReceiverBank;
        $this->Amount = $Amount;
        $this->Purpose = $Purpose;
        $this->CustomerData = $CustomerData;
        $this->ReadingArea = $ReadingArea;
        $this->Currency = $Currency;
        $this->AccountInfo = $AccountInfo;
        $this->DueDate = $DueDate->format(\DateTime::ATOM);
        $this->DirectDebit = $DirectDebit;
        $this->ParameterSet = $ParameterSet;
    }

    public function getReceiver(): Receiver
    {
        return $this->Receiver;
    }

    public function setReceiver(Receiver $Receiver): self
    {
        $this->Receiver = $Receiver;

        return $this;
    }

    /**
     * @return ReceiverBank
     */
    public function getReceiverBank()
    {
        return $this->ReceiverBank;
    }

    /**
     * @param ReceiverBank $ReceiverBank
     */
    public function setReceiverBank($ReceiverBank): self
    {
        $this->ReceiverBank = $ReceiverBank;

        return $this;
    }

    /**
     * @return Amount
     */
    public function getAmount()
    {
        return $this->Amount;
    }

    /**
     * @param Amount $Amount
     */
    public function setAmount($Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }

    /**
     * @return Purpose
     */
    public function getPurpose()
    {
        return $this->Purpose;
    }

    /**
     * @param Purpose $Purpose
     */
    public function setPurpose($Purpose): self
    {
        $this->Purpose = $Purpose;

        return $this;
    }

    public function getCustomerData(): string
    {
        return $this->CustomerData;
    }

    public function setCustomerData(string $CustomerData): self
    {
        $this->CustomerData = $CustomerData;

        return $this;
    }

    /**
     * @return ReadingArea
     */
    public function getReadingArea()
    {
        return $this->ReadingArea;
    }

    /**
     * @param ReadingArea $ReadingArea
     */
    public function setReadingArea($ReadingArea): self
    {
        $this->ReadingArea = $ReadingArea;

        return $this;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->Currency;
    }

    /**
     * @param Currency $Currency
     */
    public function setCurrency($Currency): self
    {
        $this->Currency = $Currency;

        return $this;
    }

    public function getAccountInfo(): AccountInfo
    {
        return $this->AccountInfo;
    }

    public function setAccountInfo(AccountInfo $AccountInfo): self
    {
        $this->AccountInfo = $AccountInfo;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDueDate()
    {
        if ($this->DueDate === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->DueDate);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    public function setDueDate(\DateTime $DueDate): self
    {
        $this->DueDate = $DueDate->format(\DateTime::ATOM);

        return $this;
    }

    public function getDirectDebit(): bool
    {
        return $this->DirectDebit;
    }

    public function setDirectDebit(bool $DirectDebit): self
    {
        $this->DirectDebit = $DirectDebit;

        return $this;
    }

    public function getParameterSet(): ParameterSet
    {
        return $this->ParameterSet;
    }

    public function setParameterSet(ParameterSet $ParameterSet): self
    {
        $this->ParameterSet = $ParameterSet;

        return $this;
    }
}
