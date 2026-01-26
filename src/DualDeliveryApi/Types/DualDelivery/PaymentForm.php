<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class PaymentForm
{
    /**
     * @var string
     */
    protected $Receiver;

    /**
     * @var ?string
     */
    protected $ReceiverBank;

    /**
     * @var ?string
     */
    protected $Amount;

    /**
     * @var ?string
     */
    protected $Purpose;

    /**
     * @var ?string
     */
    protected $CustomerData;

    /**
     * @var ?string
     */
    protected $ReadingArea;

    /**
     * @var ?string
     */
    protected $Currency;

    /**
     * @var ?AccountInfo
     */
    protected $AccountInfo;

    /**
     * @var ?string
     */
    protected $DueDate;

    /**
     * @var ?bool
     */
    protected $DirectDebit;

    /**
     * @var ?ParameterSet
     */
    protected $ParameterSet;

    public function __construct(string $Receiver, ?string $ReceiverBank, ?string $Amount, ?string $Purpose, ?string $CustomerData, ?string $ReadingArea, ?string $Currency, ?AccountInfo $AccountInfo, ?\DateTimeInterface $DueDate, ?bool $DirectDebit, ?ParameterSet $ParameterSet)
    {
        $this->Receiver = $Receiver;
        $this->ReceiverBank = $ReceiverBank;
        $this->Amount = $Amount;
        $this->Purpose = $Purpose;
        $this->CustomerData = $CustomerData;
        $this->ReadingArea = $ReadingArea;
        $this->Currency = $Currency;
        $this->AccountInfo = $AccountInfo;
        if ($DueDate !== null) {
            $this->DueDate = $DueDate->format(\DateTime::ATOM);
        }
        $this->DirectDebit = $DirectDebit;
        $this->ParameterSet = $ParameterSet;
    }

    public function getReceiver(): string
    {
        return $this->Receiver;
    }

    public function setReceiver(string $Receiver): void
    {
        $this->Receiver = $Receiver;
    }

    public function getReceiverBank(): ?string
    {
        return $this->ReceiverBank;
    }

    public function setReceiverBank(string $ReceiverBank): void
    {
        $this->ReceiverBank = $ReceiverBank;
    }

    public function getAmount(): ?string
    {
        return $this->Amount;
    }

    public function setAmount(string $Amount): void
    {
        $this->Amount = $Amount;
    }

    public function getPurpose(): ?string
    {
        return $this->Purpose;
    }

    public function setPurpose(string $Purpose): void
    {
        $this->Purpose = $Purpose;
    }

    public function getCustomerData(): ?string
    {
        return $this->CustomerData;
    }

    public function setCustomerData(string $CustomerData): void
    {
        $this->CustomerData = $CustomerData;
    }

    public function getReadingArea(): ?string
    {
        return $this->ReadingArea;
    }

    public function setReadingArea(string $ReadingArea): void
    {
        $this->ReadingArea = $ReadingArea;
    }

    public function getCurrency(): ?string
    {
        return $this->Currency;
    }

    public function setCurrency(string $Currency): void
    {
        $this->Currency = $Currency;
    }

    public function getAccountInfo(): ?AccountInfo
    {
        return $this->AccountInfo;
    }

    public function setAccountInfo(AccountInfo $AccountInfo): void
    {
        $this->AccountInfo = $AccountInfo;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        if ($this->DueDate === null) {
            return null;
        }

        return new \DateTimeImmutable($this->DueDate);
    }

    public function setDueDate(\DateTimeInterface $DueDate): void
    {
        $this->DueDate = $DueDate->format(\DateTime::ATOM);
    }

    public function getDirectDebit(): ?bool
    {
        return $this->DirectDebit;
    }

    public function setDirectDebit(bool $DirectDebit): void
    {
        $this->DirectDebit = $DirectDebit;
    }

    public function getParameterSet(): ?ParameterSet
    {
        return $this->ParameterSet;
    }

    public function setParameterSet(ParameterSet $ParameterSet): void
    {
        $this->ParameterSet = $ParameterSet;
    }
}
