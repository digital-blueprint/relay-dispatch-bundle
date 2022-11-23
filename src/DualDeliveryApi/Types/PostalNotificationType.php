<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PostalNotificationType extends NotificationChannelSetType
{
    /**
     * @var ?int
     */
    protected $Pages = null;

    /**
     * @var ?string
     */
    protected $Printtime = null;

    /**
     * @var ?string
     */
    protected $PrintType = null;

    /**
     * @var ?string
     */
    protected $Weight = null;

    /**
     * @var ?string
     */
    protected $EnvelopeType = null;

    /**
     * @var ?string
     */
    protected $PostalDeliveryTime = null;

    /**
     * @var ?string
     */
    protected $ServiceDeliveryTime = null;

    /**
     * @var ?int
     */
    protected $Sheets = null;

    /**
     * @var ?int
     */
    protected $PaymentForms = null;

    /**
     * @var Costs
     */
    protected $Costs = null;

    /**
     * @var ?AdditonalPrintResults
     */
    protected $AdditonalPrintResults = null;

    /**
     * @var ?DelivererInformation
     */
    protected $DelivererInformation = null;

    /**
     * @var ?ScannedData
     */
    protected $ScannedData = null;

    public function __construct()
    {
    }

    public function getPages(): ?int
    {
        return $this->Pages;
    }

    public function setPages(int $Pages): void
    {
        $this->Pages = $Pages;
    }

    public function getPrinttime(): ?\DateTimeInterface
    {
        if ($this->Printtime === null) {
            return null;
        } else {
            return new \DateTimeImmutable($this->Printtime);
        }
    }

    public function setPrinttime(\DateTimeInterface $Printtime): void
    {
        $this->Printtime = $Printtime->format(\DateTime::ATOM);
    }

    public function getPrintType(): ?string
    {
        return $this->PrintType;
    }

    public function setPrintType(string $PrintType): void
    {
        $this->PrintType = $PrintType;
    }

    public function getWeight(): ?string
    {
        return $this->Weight;
    }

    public function setWeight(string $Weight): void
    {
        $this->Weight = $Weight;
    }

    public function getEnvelopeType(): ?string
    {
        return $this->EnvelopeType;
    }

    public function setEnvelopeType(string $EnvelopeType): void
    {
        $this->EnvelopeType = $EnvelopeType;
    }

    public function getPostalDeliveryTime(): ?\DateTimeInterface
    {
        if ($this->PostalDeliveryTime === null) {
            return null;
        } else {
            return new \DateTime($this->PostalDeliveryTime);
        }
    }

    public function setPostalDeliveryTime(\DateTimeInterface $PostalDeliveryTime): void
    {
        $this->PostalDeliveryTime = $PostalDeliveryTime->format(\DateTime::ATOM);
    }

    public function getServiceDeliveryTime(): ?\DateTimeInterface
    {
        if ($this->ServiceDeliveryTime === null) {
            return null;
        } else {
            return new \DateTimeImmutable($this->ServiceDeliveryTime);
        }
    }

    public function setServiceDeliveryTime(\DateTimeInterface $ServiceDeliveryTime): void
    {
        $this->ServiceDeliveryTime = $ServiceDeliveryTime->format(\DateTime::ATOM);
    }

    public function getSheets(): ?int
    {
        return $this->Sheets;
    }

    public function setSheets(int $Sheets): void
    {
        $this->Sheets = $Sheets;
    }

    public function getPaymentForms(): ?int
    {
        return $this->PaymentForms;
    }

    public function setPaymentForms(int $PaymentForms): void
    {
        $this->PaymentForms = $PaymentForms;
    }

    public function getCosts(): Costs
    {
        return $this->Costs;
    }

    public function setCosts(Costs $Costs): void
    {
        $this->Costs = $Costs;
    }

    public function getAdditonalPrintResults(): ?AdditonalPrintResults
    {
        return $this->AdditonalPrintResults;
    }

    public function setAdditonalPrintResults(AdditonalPrintResults $AdditonalPrintResults): void
    {
        $this->AdditonalPrintResults = $AdditonalPrintResults;
    }

    public function getDelivererInformation(): ?DelivererInformation
    {
        return $this->DelivererInformation;
    }

    public function setDelivererInformation(DelivererInformation $DelivererInformation): void
    {
        $this->DelivererInformation = $DelivererInformation;
    }

    public function getScannedData(): ?ScannedData
    {
        return $this->ScannedData;
    }

    public function setScannedData(ScannedData $ScannedData): void
    {
        $this->ScannedData = $ScannedData;
    }
}
