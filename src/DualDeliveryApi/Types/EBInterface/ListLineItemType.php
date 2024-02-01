<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class ListLineItemType
{
    /**
     * @var int
     */
    protected $PositionNumber;

    /**
     * @var string
     */
    protected $Description;

    /**
     * @var ArticleNumberType
     */
    protected $ArticleNumber;

    /**
     * @var UnitType
     */
    protected $Quantity;

    /**
     * @var Decimal4Type
     */
    protected $UnitPrice;

    /**
     * @var TaxRateType
     */
    protected $TaxRate;

    /**
     * @var bool
     */
    protected $DiscountFlag;

    /**
     * @var ReductionAndSurchargeListLineItemDetailsType
     */
    protected $ReductionAndSurchargeListLineItemDetails;

    /**
     * @var DeliveryType
     */
    protected $Delivery;

    /**
     * @var OrderReferenceDetailType
     */
    protected $BillersOrderReference;

    /**
     * @var OrderReferenceDetailType
     */
    protected $InvoiceRecipientsOrderReference;

    /**
     * @var AdditionalInformationType
     */
    protected $AdditionalInformation;

    /**
     * @var Decimal2Type
     */
    protected $LineItemAmount;

    /**
     * @var ListLineItemExtensionType
     */
    protected $ListLineItemExtension;

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

    public function getPositionNumber(): int
    {
        return $this->PositionNumber;
    }

    public function setPositionNumber(int $PositionNumber): self
    {
        $this->PositionNumber = $PositionNumber;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getArticleNumber(): ArticleNumberType
    {
        return $this->ArticleNumber;
    }

    public function setArticleNumber(ArticleNumberType $ArticleNumber): self
    {
        $this->ArticleNumber = $ArticleNumber;

        return $this;
    }

    public function getQuantity(): UnitType
    {
        return $this->Quantity;
    }

    public function setQuantity(UnitType $Quantity): self
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
     */
    public function setUnitPrice($UnitPrice): self
    {
        $this->UnitPrice = $UnitPrice;

        return $this;
    }

    public function getTaxRate(): TaxRateType
    {
        return $this->TaxRate;
    }

    public function setTaxRate(TaxRateType $TaxRate): self
    {
        $this->TaxRate = $TaxRate;

        return $this;
    }

    public function getDiscountFlag(): bool
    {
        return $this->DiscountFlag;
    }

    public function setDiscountFlag(bool $DiscountFlag): self
    {
        $this->DiscountFlag = $DiscountFlag;

        return $this;
    }

    public function getReductionAndSurchargeListLineItemDetails(): ReductionAndSurchargeListLineItemDetailsType
    {
        return $this->ReductionAndSurchargeListLineItemDetails;
    }

    public function setReductionAndSurchargeListLineItemDetails(ReductionAndSurchargeListLineItemDetailsType $ReductionAndSurchargeListLineItemDetails): self
    {
        $this->ReductionAndSurchargeListLineItemDetails = $ReductionAndSurchargeListLineItemDetails;

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

    public function getBillersOrderReference(): OrderReferenceDetailType
    {
        return $this->BillersOrderReference;
    }

    public function setBillersOrderReference(OrderReferenceDetailType $BillersOrderReference): self
    {
        $this->BillersOrderReference = $BillersOrderReference;

        return $this;
    }

    public function getInvoiceRecipientsOrderReference(): OrderReferenceDetailType
    {
        return $this->InvoiceRecipientsOrderReference;
    }

    public function setInvoiceRecipientsOrderReference(OrderReferenceDetailType $InvoiceRecipientsOrderReference): self
    {
        $this->InvoiceRecipientsOrderReference = $InvoiceRecipientsOrderReference;

        return $this;
    }

    public function getAdditionalInformation(): AdditionalInformationType
    {
        return $this->AdditionalInformation;
    }

    public function setAdditionalInformation(AdditionalInformationType $AdditionalInformation): self
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
     */
    public function setLineItemAmount($LineItemAmount): self
    {
        $this->LineItemAmount = $LineItemAmount;

        return $this;
    }

    public function getListLineItemExtension(): ListLineItemExtensionType
    {
        return $this->ListLineItemExtension;
    }

    public function setListLineItemExtension(ListLineItemExtensionType $ListLineItemExtension): self
    {
        $this->ListLineItemExtension = $ListLineItemExtension;

        return $this;
    }
}
