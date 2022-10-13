<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class InvoiceType
{
    /**
     * @var SignatureType
     */
    protected $Signature = null;

    /**
     * @var AlphaNumIDType
     */
    protected $InvoiceNumber = null;

    /**
     * @var date
     */
    protected $InvoiceDate = null;

    /**
     * @var DeliveryType
     */
    protected $Delivery = null;

    /**
     * @var BillerType
     */
    protected $Biller = null;

    /**
     * @var InvoiceRecipientType
     */
    protected $InvoiceRecipient = null;

    /**
     * @var OrderingPartyType
     */
    protected $OrderingParty = null;

    /**
     * @var DetailsType
     */
    protected $Details = null;

    /**
     * @var ReductionAndSurchargeDetailsType
     */
    protected $ReductionAndSurchargeDetails = null;

    /**
     * @var TaxType
     */
    protected $Tax = null;

    /**
     * @var Decimal2Type
     */
    protected $TotalGrossAmount = null;

    /**
     * @var PaymentMethodType
     */
    protected $PaymentMethod = null;

    /**
     * @var PaymentConditionsType
     */
    protected $PaymentConditions = null;

    /**
     * @var PresentationDetailsType
     */
    protected $PresentationDetails = null;

    /**
     * @var InvoiceRootExtensionType
     */
    protected $InvoiceRootExtension = null;

    /**
     * @var string
     */
    protected $GeneratingSystem = null;

    /**
     * @var AlphaNumIDType
     */
    protected $CancelledOriginalDocument = null;

    /**
     * @var DocumentTypeType
     */
    protected $DocumentType = null;

    /**
     * @var CurrencyType
     */
    protected $InvoiceCurrency = null;

    /**
     * @var bool
     */
    protected $ManualProcessing = null;

    /**
     * @var string
     */
    protected $DocumentTitle = null;

    /**
     * @var LanguageType
     */
    protected $Language = null;

    /**
     * @param SignatureType                    $Signature
     * @param AlphaNumIDType                   $InvoiceNumber
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
     * @param AlphaNumIDType                   $CancelledOriginalDocument
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

    /**
     * @return SignatureType
     */
    public function getSignature()
    {
        return $this->Signature;
    }

    /**
     * @param SignatureType $Signature
     *
     * @return InvoiceType
     */
    public function setSignature($Signature)
    {
        $this->Signature = $Signature;

        return $this;
    }

    /**
     * @return AlphaNumIDType
     */
    public function getInvoiceNumber()
    {
        return $this->InvoiceNumber;
    }

    /**
     * @param AlphaNumIDType $InvoiceNumber
     *
     * @return InvoiceType
     */
    public function setInvoiceNumber($InvoiceNumber)
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
     *
     * @return InvoiceType
     */
    public function setInvoiceDate($InvoiceDate)
    {
        $this->InvoiceDate = $InvoiceDate;

        return $this;
    }

    /**
     * @return DeliveryType
     */
    public function getDelivery()
    {
        return $this->Delivery;
    }

    /**
     * @param DeliveryType $Delivery
     *
     * @return InvoiceType
     */
    public function setDelivery($Delivery)
    {
        $this->Delivery = $Delivery;

        return $this;
    }

    /**
     * @return BillerType
     */
    public function getBiller()
    {
        return $this->Biller;
    }

    /**
     * @param BillerType $Biller
     *
     * @return InvoiceType
     */
    public function setBiller($Biller)
    {
        $this->Biller = $Biller;

        return $this;
    }

    /**
     * @return InvoiceRecipientType
     */
    public function getInvoiceRecipient()
    {
        return $this->InvoiceRecipient;
    }

    /**
     * @param InvoiceRecipientType $InvoiceRecipient
     *
     * @return InvoiceType
     */
    public function setInvoiceRecipient($InvoiceRecipient)
    {
        $this->InvoiceRecipient = $InvoiceRecipient;

        return $this;
    }

    /**
     * @return OrderingPartyType
     */
    public function getOrderingParty()
    {
        return $this->OrderingParty;
    }

    /**
     * @param OrderingPartyType $OrderingParty
     *
     * @return InvoiceType
     */
    public function setOrderingParty($OrderingParty)
    {
        $this->OrderingParty = $OrderingParty;

        return $this;
    }

    /**
     * @return DetailsType
     */
    public function getDetails()
    {
        return $this->Details;
    }

    /**
     * @param DetailsType $Details
     *
     * @return InvoiceType
     */
    public function setDetails($Details)
    {
        $this->Details = $Details;

        return $this;
    }

    /**
     * @return ReductionAndSurchargeDetailsType
     */
    public function getReductionAndSurchargeDetails()
    {
        return $this->ReductionAndSurchargeDetails;
    }

    /**
     * @param ReductionAndSurchargeDetailsType $ReductionAndSurchargeDetails
     *
     * @return InvoiceType
     */
    public function setReductionAndSurchargeDetails($ReductionAndSurchargeDetails)
    {
        $this->ReductionAndSurchargeDetails = $ReductionAndSurchargeDetails;

        return $this;
    }

    /**
     * @return TaxType
     */
    public function getTax()
    {
        return $this->Tax;
    }

    /**
     * @param TaxType $Tax
     *
     * @return InvoiceType
     */
    public function setTax($Tax)
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
     *
     * @return InvoiceType
     */
    public function setTotalGrossAmount($TotalGrossAmount)
    {
        $this->TotalGrossAmount = $TotalGrossAmount;

        return $this;
    }

    /**
     * @return PaymentMethodType
     */
    public function getPaymentMethod()
    {
        return $this->PaymentMethod;
    }

    /**
     * @param PaymentMethodType $PaymentMethod
     *
     * @return InvoiceType
     */
    public function setPaymentMethod($PaymentMethod)
    {
        $this->PaymentMethod = $PaymentMethod;

        return $this;
    }

    /**
     * @return PaymentConditionsType
     */
    public function getPaymentConditions()
    {
        return $this->PaymentConditions;
    }

    /**
     * @param PaymentConditionsType $PaymentConditions
     *
     * @return InvoiceType
     */
    public function setPaymentConditions($PaymentConditions)
    {
        $this->PaymentConditions = $PaymentConditions;

        return $this;
    }

    /**
     * @return PresentationDetailsType
     */
    public function getPresentationDetails()
    {
        return $this->PresentationDetails;
    }

    /**
     * @param PresentationDetailsType $PresentationDetails
     *
     * @return InvoiceType
     */
    public function setPresentationDetails($PresentationDetails)
    {
        $this->PresentationDetails = $PresentationDetails;

        return $this;
    }

    /**
     * @return InvoiceRootExtensionType
     */
    public function getInvoiceRootExtension()
    {
        return $this->InvoiceRootExtension;
    }

    /**
     * @param InvoiceRootExtensionType $InvoiceRootExtension
     *
     * @return InvoiceType
     */
    public function setInvoiceRootExtension($InvoiceRootExtension)
    {
        $this->InvoiceRootExtension = $InvoiceRootExtension;

        return $this;
    }

    /**
     * @return string
     */
    public function getGeneratingSystem()
    {
        return $this->GeneratingSystem;
    }

    /**
     * @param string $GeneratingSystem
     *
     * @return InvoiceType
     */
    public function setGeneratingSystem($GeneratingSystem)
    {
        $this->GeneratingSystem = $GeneratingSystem;

        return $this;
    }

    /**
     * @return AlphaNumIDType
     */
    public function getCancelledOriginalDocument()
    {
        return $this->CancelledOriginalDocument;
    }

    /**
     * @param AlphaNumIDType $CancelledOriginalDocument
     *
     * @return InvoiceType
     */
    public function setCancelledOriginalDocument($CancelledOriginalDocument)
    {
        $this->CancelledOriginalDocument = $CancelledOriginalDocument;

        return $this;
    }

    /**
     * @return DocumentTypeType
     */
    public function getDocumentType()
    {
        return $this->DocumentType;
    }

    /**
     * @param DocumentTypeType $DocumentType
     *
     * @return InvoiceType
     */
    public function setDocumentType($DocumentType)
    {
        $this->DocumentType = $DocumentType;

        return $this;
    }

    /**
     * @return CurrencyType
     */
    public function getInvoiceCurrency()
    {
        return $this->InvoiceCurrency;
    }

    /**
     * @param CurrencyType $InvoiceCurrency
     *
     * @return InvoiceType
     */
    public function setInvoiceCurrency($InvoiceCurrency)
    {
        $this->InvoiceCurrency = $InvoiceCurrency;

        return $this;
    }

    /**
     * @return bool
     */
    public function getManualProcessing()
    {
        return $this->ManualProcessing;
    }

    /**
     * @param bool $ManualProcessing
     *
     * @return InvoiceType
     */
    public function setManualProcessing($ManualProcessing)
    {
        $this->ManualProcessing = $ManualProcessing;

        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentTitle()
    {
        return $this->DocumentTitle;
    }

    /**
     * @param string $DocumentTitle
     *
     * @return InvoiceType
     */
    public function setDocumentTitle($DocumentTitle)
    {
        $this->DocumentTitle = $DocumentTitle;

        return $this;
    }

    /**
     * @return LanguageType
     */
    public function getLanguage()
    {
        return $this->Language;
    }

    /**
     * @param LanguageType $Language
     *
     * @return InvoiceType
     */
    public function setLanguage($Language)
    {
        $this->Language = $Language;

        return $this;
    }
}
