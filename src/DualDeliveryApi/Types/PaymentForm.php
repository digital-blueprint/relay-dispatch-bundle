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

    /**
     * @return Receiver
     */
    public function getReceiver()
    {
        return $this->Receiver;
    }

    /**
     * @param Receiver $Receiver
     *
     * @return PaymentForm
     */
    public function setReceiver($Receiver)
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
     *
     * @return PaymentForm
     */
    public function setReceiverBank($ReceiverBank)
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
     *
     * @return PaymentForm
     */
    public function setAmount($Amount)
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
     *
     * @return PaymentForm
     */
    public function setPurpose($Purpose)
    {
        $this->Purpose = $Purpose;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerData()
    {
        return $this->CustomerData;
    }

    /**
     * @param string $CustomerData
     *
     * @return PaymentForm
     */
    public function setCustomerData($CustomerData)
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
     *
     * @return PaymentForm
     */
    public function setReadingArea($ReadingArea)
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
     *
     * @return PaymentForm
     */
    public function setCurrency($Currency)
    {
        $this->Currency = $Currency;

        return $this;
    }

    /**
     * @return AccountInfo
     */
    public function getAccountInfo()
    {
        return $this->AccountInfo;
    }

    /**
     * @param AccountInfo $AccountInfo
     *
     * @return PaymentForm
     */
    public function setAccountInfo($AccountInfo)
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

    /**
     * @return PaymentForm
     */
    public function setDueDate(\DateTime $DueDate)
    {
        $this->DueDate = $DueDate->format(\DateTime::ATOM);

        return $this;
    }

    /**
     * @return bool
     */
    public function getDirectDebit()
    {
        return $this->DirectDebit;
    }

    /**
     * @param bool $DirectDebit
     *
     * @return PaymentForm
     */
    public function setDirectDebit($DirectDebit)
    {
        $this->DirectDebit = $DirectDebit;

        return $this;
    }

    /**
     * @return ParameterSet
     */
    public function getParameterSet()
    {
        return $this->ParameterSet;
    }

    /**
     * @param ParameterSet $ParameterSet
     *
     * @return PaymentForm
     */
    public function setParameterSet($ParameterSet)
    {
        $this->ParameterSet = $ParameterSet;

        return $this;
    }
}
