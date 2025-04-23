<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\date;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Decimal2Type;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig\SignatureType;

class InvoiceType
{
    /**
     * @var SignatureType
     */
    protected $Signature;

    /**
     * @var string
     */
    protected $InvoiceNumber;

    /**
     * @var date
     */
    protected $InvoiceDate;

    /**
     * @var DeliveryType
     */
    protected $Delivery;

    /**
     * @var BillerType
     */
    protected $Biller;

    /**
     * @var InvoiceRecipientType
     */
    protected $InvoiceRecipient;

    /**
     * @var OrderingPartyType
     */
    protected $OrderingParty;

    /**
     * @var DetailsType
     */
    protected $Details;

    /**
     * @var ReductionAndSurchargeDetailsType
     */
    protected $ReductionAndSurchargeDetails;

    /**
     * @var TaxType
     */
    protected $Tax;

    /**
     * @var Decimal2Type
     */
    protected $TotalGrossAmount;

    /**
     * @var PaymentMethodType
     */
    protected $PaymentMethod;

    /**
     * @var PaymentConditionsType
     */
    protected $PaymentConditions;

    /**
     * @var PresentationDetailsType
     */
    protected $PresentationDetails;

    /**
     * @var InvoiceRootExtensionType
     */
    protected $InvoiceRootExtension;

    /**
     * @var string
     */
    protected $GeneratingSystem;

    /**
     * @var string
     */
    protected $CancelledOriginalDocument;

    /**
     * @var DocumentTypeType
     */
    protected $DocumentType;

    /**
     * @var CurrencyType
     */
    protected $InvoiceCurrency;

    /**
     * @var bool
     */
    protected $ManualProcessing;

    /**
     * @var string
     */
    protected $DocumentTitle;

    /**
     * @var LanguageType
     */
    protected $Language;

    /**
     * @param SignatureType                    $Signature
     * @param string                           $InvoiceNumber
     * @param date                             $InvoiceDate
     * @param DeliveryType                     $Delivery
     * @param BillerType                       $Biller
     * @param InvoiceRecipientType             $InvoiceRecipient
     * @param OrderingPartyType                $OrderingParty
     * @param DetailsType                      $Details
     * @param ReductionAndSurchargeDetailsType $ReductionAndSurchargeDetails
     * @param TaxType                          $Tax
     * @param Decimal2Type                     $TotalGrossAmount
     * @param PaymentMethodType                $PaymentMethod
     * @param PaymentConditionsType            $PaymentConditions
     * @param PresentationDetailsType          $PresentationDetails
     * @param InvoiceRootExtensionType         $InvoiceRootExtension
     * @param string                           $GeneratingSystem
     * @param string                           $CancelledOriginalDocument
     * @param DocumentTypeType                 $DocumentType
     * @param CurrencyType                     $InvoiceCurrency
     * @param bool                             $ManualProcessing
     * @param string                           $DocumentTitle
     * @param LanguageType                     $Language
     */
    public function __construct($Signature, $InvoiceNumber, $InvoiceDate, $Delivery, $Biller, $InvoiceRecipient, $OrderingParty, $Details, $ReductionAndSurchargeDetails, $Tax, $TotalGrossAmount, $PaymentMethod, $PaymentConditions, $PresentationDetails, $InvoiceRootExtension, $GeneratingSystem, $CancelledOriginalDocument, $DocumentType, $InvoiceCurrency, $ManualProcessing, $DocumentTitle, $Language)
    {
        $this->Signature = $Signature;
        $this->InvoiceNumber = $InvoiceNumber;
        $this->InvoiceDate = $InvoiceDate;
        $this->Delivery = $Delivery;
        $this->Biller = $Biller;
        $this->InvoiceRecipient = $InvoiceRecipient;
        $this->OrderingParty = $OrderingParty;
        $this->Details = $Details;
        $this->ReductionAndSurchargeDetails = $ReductionAndSurchargeDetails;
        $this->Tax = $Tax;
        $this->TotalGrossAmount = $TotalGrossAmount;
        $this->PaymentMethod = $PaymentMethod;
        $this->PaymentConditions = $PaymentConditions;
        $this->PresentationDetails = $PresentationDetails;
        $this->InvoiceRootExtension = $InvoiceRootExtension;
        $this->GeneratingSystem = $GeneratingSystem;
        $this->CancelledOriginalDocument = $CancelledOriginalDocument;
        $this->DocumentType = $DocumentType;
        $this->InvoiceCurrency = $InvoiceCurrency;
        $this->ManualProcessing = $ManualProcessing;
        $this->DocumentTitle = $DocumentTitle;
        $this->Language = $Language;
    }

    public function getSignature(): SignatureType
    {
        return $this->Signature;
    }

    public function setSignature(SignatureType $Signature): self
    {
        $this->Signature = $Signature;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->InvoiceNumber;
    }

    /**
     * @param string $InvoiceNumber
     */
    public function setInvoiceNumber($InvoiceNumber): self
    {
        $this->InvoiceNumber = $InvoiceNumber;

        return $this;
    }

    /**
     * @return date
     */
    public function getInvoiceDate()
    {
        return $this->InvoiceDate;
    }

    /**
     * @param date $InvoiceDate
     */
    public function setInvoiceDate($InvoiceDate): self
    {
        $this->InvoiceDate = $InvoiceDate;

        return $this;
    }

    public function getDelivery(): DeliveryType
    {
        return $this->Delivery;
    }

    public function setDelivery(DeliveryType $Delivery): self
    {
        $this->Delivery = $Delivery;

        return $this;
    }

    public function getBiller(): BillerType
    {
        return $this->Biller;
    }

    public function setBiller(BillerType $Biller): self
    {
        $this->Biller = $Biller;

        return $this;
    }

    public function getInvoiceRecipient(): InvoiceRecipientType
    {
        return $this->InvoiceRecipient;
    }

    public function setInvoiceRecipient(InvoiceRecipientType $InvoiceRecipient): self
    {
        $this->InvoiceRecipient = $InvoiceRecipient;

        return $this;
    }

    public function getOrderingParty(): OrderingPartyType
    {
        return $this->OrderingParty;
    }

    public function setOrderingParty(OrderingPartyType $OrderingParty): self
    {
        $this->OrderingParty = $OrderingParty;

        return $this;
    }

    public function getDetails(): DetailsType
    {
        return $this->Details;
    }

    public function setDetails(DetailsType $Details): self
    {
        $this->Details = $Details;

        return $this;
    }

    public function getReductionAndSurchargeDetails(): ReductionAndSurchargeDetailsType
    {
        return $this->ReductionAndSurchargeDetails;
    }

    public function setReductionAndSurchargeDetails(ReductionAndSurchargeDetailsType $ReductionAndSurchargeDetails): self
    {
        $this->ReductionAndSurchargeDetails = $ReductionAndSurchargeDetails;

        return $this;
    }

    public function getTax(): TaxType
    {
        return $this->Tax;
    }

    public function setTax(TaxType $Tax): self
    {
        $this->Tax = $Tax;

        return $this;
    }

    /**
     * @return Decimal2Type
     */
    public function getTotalGrossAmount()
    {
        return $this->TotalGrossAmount;
    }

    /**
     * @param Decimal2Type $TotalGrossAmount
     */
    public function setTotalGrossAmount($TotalGrossAmount): self
    {
        $this->TotalGrossAmount = $TotalGrossAmount;

        return $this;
    }

    public function getPaymentMethod(): PaymentMethodType
    {
        return $this->PaymentMethod;
    }

    public function setPaymentMethod(PaymentMethodType $PaymentMethod): self
    {
        $this->PaymentMethod = $PaymentMethod;

        return $this;
    }

    public function getPaymentConditions(): PaymentConditionsType
    {
        return $this->PaymentConditions;
    }

    public function setPaymentConditions(PaymentConditionsType $PaymentConditions): self
    {
        $this->PaymentConditions = $PaymentConditions;

        return $this;
    }

    public function getPresentationDetails(): PresentationDetailsType
    {
        return $this->PresentationDetails;
    }

    public function setPresentationDetails(PresentationDetailsType $PresentationDetails): self
    {
        $this->PresentationDetails = $PresentationDetails;

        return $this;
    }

    public function getInvoiceRootExtension(): InvoiceRootExtensionType
    {
        return $this->InvoiceRootExtension;
    }

    public function setInvoiceRootExtension(InvoiceRootExtensionType $InvoiceRootExtension): self
    {
        $this->InvoiceRootExtension = $InvoiceRootExtension;

        return $this;
    }

    public function getGeneratingSystem(): string
    {
        return $this->GeneratingSystem;
    }

    public function setGeneratingSystem(string $GeneratingSystem): self
    {
        $this->GeneratingSystem = $GeneratingSystem;

        return $this;
    }

    /**
     * @return string
     */
    public function getCancelledOriginalDocument()
    {
        return $this->CancelledOriginalDocument;
    }

    /**
     * @param string $CancelledOriginalDocument
     */
    public function setCancelledOriginalDocument($CancelledOriginalDocument): self
    {
        $this->CancelledOriginalDocument = $CancelledOriginalDocument;

        return $this;
    }

    public function getDocumentType(): DocumentTypeType
    {
        return $this->DocumentType;
    }

    public function setDocumentType(DocumentTypeType $DocumentType): self
    {
        $this->DocumentType = $DocumentType;

        return $this;
    }

    public function getInvoiceCurrency(): CurrencyType
    {
        return $this->InvoiceCurrency;
    }

    public function setInvoiceCurrency(CurrencyType $InvoiceCurrency): self
    {
        $this->InvoiceCurrency = $InvoiceCurrency;

        return $this;
    }

    public function getManualProcessing(): bool
    {
        return $this->ManualProcessing;
    }

    public function setManualProcessing(bool $ManualProcessing): self
    {
        $this->ManualProcessing = $ManualProcessing;

        return $this;
    }

    public function getDocumentTitle(): string
    {
        return $this->DocumentTitle;
    }

    public function setDocumentTitle(string $DocumentTitle): self
    {
        $this->DocumentTitle = $DocumentTitle;

        return $this;
    }

    public function getLanguage(): LanguageType
    {
        return $this->Language;
    }

    public function setLanguage(LanguageType $Language): self
    {
        $this->Language = $Language;

        return $this;
    }
}
