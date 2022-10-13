<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ListLineItemType
{
    /**
     * @var int
     */
    protected $PositionNumber = null;

    /**
     * @var string
     */
    protected $Description = null;

    /**
     * @var ArticleNumberType
     */
    protected $ArticleNumber = null;

    /**
     * @var UnitType
     */
    protected $Quantity = null;

    /**
     * @var Decimal4Type
     */
    protected $UnitPrice = null;

    /**
     * @var TaxRateType
     */
    protected $TaxRate = null;

    /**
     * @var bool
     */
    protected $DiscountFlag = null;

    /**
     * @var ReductionAndSurchargeListLineItemDetailsType
     */
    protected $ReductionAndSurchargeListLineItemDetails = null;

    /**
     * @var DeliveryType
     */
    protected $Delivery = null;

    /**
     * @var OrderReferenceDetailType
     */
    protected $BillersOrderReference = null;

    /**
     * @var OrderReferenceDetailType
     */
    protected $InvoiceRecipientsOrderReference = null;

    /**
     * @var AdditionalInformationType
     */
    protected $AdditionalInformation = null;

    /**
     * @var Decimal2Type
     */
    protected $LineItemAmount = null;

    /**
     * @var ListLineItemExtensionType
     */
    protected $ListLineItemExtension = null;

    /**
     * @param int                                          $PositionNumber
     * @param string                                       $Description
     * @param ArticleNumberType                            $ArticleNumber
     * @param UnitType                                     $Quantity
     * @param Decimal4Type                                 $UnitPrice
     * @param TaxRateType                                  $TaxRate
     * @param bool                                         $DiscountFlag
     * @param ReductionAndSurchargeListLineItemDetailsType $ReductionAndSurchargeListLineItemDetails
     * @param DeliveryType                                 $Delivery
     * @param OrderReferenceDetailType                     $BillersOrderReference
     * @param OrderReferenceDetailType                     $InvoiceRecipientsOrderReference
     * @param AdditionalInformationType                    $AdditionalInformation
     * @param Decimal2Type                                 $LineItemAmount
     * @param ListLineItemExtensionType                    $ListLineItemExtension
     */
    public function __construct($PositionNumber, $Description, $ArticleNumber, $Quantity, $UnitPrice, $TaxRate, $DiscountFlag, $ReductionAndSurchargeListLineItemDetails, $Delivery, $BillersOrderReference, $InvoiceRecipientsOrderReference, $AdditionalInformation, $LineItemAmount, $ListLineItemExtension)
    {
        $this->PositionNumber = $PositionNumber;
        $this->Description = $Description;
        $this->ArticleNumber = $ArticleNumber;
        $this->Quantity = $Quantity;
        $this->UnitPrice = $UnitPrice;
        $this->TaxRate = $TaxRate;
        $this->DiscountFlag = $DiscountFlag;
        $this->ReductionAndSurchargeListLineItemDetails = $ReductionAndSurchargeListLineItemDetails;
        $this->Delivery = $Delivery;
        $this->BillersOrderReference = $BillersOrderReference;
        $this->InvoiceRecipientsOrderReference = $InvoiceRecipientsOrderReference;
        $this->AdditionalInformation = $AdditionalInformation;
        $this->LineItemAmount = $LineItemAmount;
        $this->ListLineItemExtension = $ListLineItemExtension;
    }

    /**
     * @return int
     */
    public function getPositionNumber()
    {
        return $this->PositionNumber;
    }

    /**
     * @param int $PositionNumber
     *
     * @return ListLineItemType
     */
    public function setPositionNumber($PositionNumber)
    {
        $this->PositionNumber = $PositionNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     *
     * @return ListLineItemType
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return ArticleNumberType
     */
    public function getArticleNumber()
    {
        return $this->ArticleNumber;
    }

    /**
     * @param ArticleNumberType $ArticleNumber
     *
     * @return ListLineItemType
     */
    public function setArticleNumber($ArticleNumber)
    {
        $this->ArticleNumber = $ArticleNumber;

        return $this;
    }

    /**
     * @return UnitType
     */
    public function getQuantity()
    {
        return $this->Quantity;
    }

    /**
     * @param UnitType $Quantity
     *
     * @return ListLineItemType
     */
    public function setQuantity($Quantity)
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    /**
     * @return Decimal4Type
     */
    public function getUnitPrice()
    {
        return $this->UnitPrice;
    }

    /**
     * @param Decimal4Type $UnitPrice
     *
     * @return ListLineItemType
     */
    public function setUnitPrice($UnitPrice)
    {
        $this->UnitPrice = $UnitPrice;

        return $this;
    }

    /**
     * @return TaxRateType
     */
    public function getTaxRate()
    {
        return $this->TaxRate;
    }

    /**
     * @param TaxRateType $TaxRate
     *
     * @return ListLineItemType
     */
    public function setTaxRate($TaxRate)
    {
        $this->TaxRate = $TaxRate;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDiscountFlag()
    {
        return $this->DiscountFlag;
    }

    /**
     * @param bool $DiscountFlag
     *
     * @return ListLineItemType
     */
    public function setDiscountFlag($DiscountFlag)
    {
        $this->DiscountFlag = $DiscountFlag;

        return $this;
    }

    /**
     * @return ReductionAndSurchargeListLineItemDetailsType
     */
    public function getReductionAndSurchargeListLineItemDetails()
    {
        return $this->ReductionAndSurchargeListLineItemDetails;
    }

    /**
     * @param ReductionAndSurchargeListLineItemDetailsType $ReductionAndSurchargeListLineItemDetails
     *
     * @return ListLineItemType
     */
    public function setReductionAndSurchargeListLineItemDetails($ReductionAndSurchargeListLineItemDetails)
    {
        $this->ReductionAndSurchargeListLineItemDetails = $ReductionAndSurchargeListLineItemDetails;

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
     * @return ListLineItemType
     */
    public function setDelivery($Delivery)
    {
        $this->Delivery = $Delivery;

        return $this;
    }

    /**
     * @return OrderReferenceDetailType
     */
    public function getBillersOrderReference()
    {
        return $this->BillersOrderReference;
    }

    /**
     * @param OrderReferenceDetailType $BillersOrderReference
     *
     * @return ListLineItemType
     */
    public function setBillersOrderReference($BillersOrderReference)
    {
        $this->BillersOrderReference = $BillersOrderReference;

        return $this;
    }

    /**
     * @return OrderReferenceDetailType
     */
    public function getInvoiceRecipientsOrderReference()
    {
        return $this->InvoiceRecipientsOrderReference;
    }

    /**
     * @param OrderReferenceDetailType $InvoiceRecipientsOrderReference
     *
     * @return ListLineItemType
     */
    public function setInvoiceRecipientsOrderReference($InvoiceRecipientsOrderReference)
    {
        $this->InvoiceRecipientsOrderReference = $InvoiceRecipientsOrderReference;

        return $this;
    }

    /**
     * @return AdditionalInformationType
     */
    public function getAdditionalInformation()
    {
        return $this->AdditionalInformation;
    }

    /**
     * @param AdditionalInformationType $AdditionalInformation
     *
     * @return ListLineItemType
     */
    public function setAdditionalInformation($AdditionalInformation)
    {
        $this->AdditionalInformation = $AdditionalInformation;

        return $this;
    }

    /**
     * @return Decimal2Type
     */
    public function getLineItemAmount()
    {
        return $this->LineItemAmount;
    }

    /**
     * @param Decimal2Type $LineItemAmount
     *
     * @return ListLineItemType
     */
    public function setLineItemAmount($LineItemAmount)
    {
        $this->LineItemAmount = $LineItemAmount;

        return $this;
    }

    /**
     * @return ListLineItemExtensionType
     */
    public function getListLineItemExtension()
    {
        return $this->ListLineItemExtension;
    }

    /**
     * @param ListLineItemExtensionType $ListLineItemExtension
     *
     * @return ListLineItemType
     */
    public function setListLineItemExtension($ListLineItemExtension)
    {
        $this->ListLineItemExtension = $ListLineItemExtension;

        return $this;
    }
}
