<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class BillerType
{
    /**
     * @var string
     */
    protected $VATIdentificationNumber = null;

    /**
     * @var FurtherIdentificationType
     */
    protected $FurtherIdentification = null;

    /**
     * @var AlphaNumIDType
     */
    protected $ConsolidatorsBillerID = null;

    /**
     * @var AlphaNumIDType
     */
    protected $InvoiceRecipientsBillerID = null;

    /**
     * @var OrderReferenceType
     */
    protected $OrderReference = null;

    /**
     * @var AddressType
     */
    protected $Address = null;

    /**
     * @var BillerExtensionType
     */
    protected $BillerExtension = null;

    /**
     * @param string                    $VATIdentificationNumber
     * @param FurtherIdentificationType $FurtherIdentification
     * @param AlphaNumIDType            $ConsolidatorsBillerID
     * @param AlphaNumIDType            $InvoiceRecipientsBillerID
     * @param OrderReferenceType        $OrderReference
     * @param AddressType               $Address
     * @param BillerExtensionType       $BillerExtension
     */
    public function __construct($VATIdentificationNumber, $FurtherIdentification, $ConsolidatorsBillerID, $InvoiceRecipientsBillerID, $OrderReference, $Address, $BillerExtension)
    {
        $this->VATIdentificationNumber = $VATIdentificationNumber;
        $this->FurtherIdentification = $FurtherIdentification;
        $this->ConsolidatorsBillerID = $ConsolidatorsBillerID;
        $this->InvoiceRecipientsBillerID = $InvoiceRecipientsBillerID;
        $this->OrderReference = $OrderReference;
        $this->Address = $Address;
        $this->BillerExtension = $BillerExtension;
    }

    public function getVATIdentificationNumber(): string
    {
        return $this->VATIdentificationNumber;
    }

    public function setVATIdentificationNumber(string $VATIdentificationNumber): self
    {
        $this->VATIdentificationNumber = $VATIdentificationNumber;

        return $this;
    }

    public function getFurtherIdentification(): FurtherIdentificationType
    {
        return $this->FurtherIdentification;
    }

    public function setFurtherIdentification(FurtherIdentificationType $FurtherIdentification): self
    {
        $this->FurtherIdentification = $FurtherIdentification;

        return $this;
    }

    /**
     * @return AlphaNumIDType
     */
    public function getConsolidatorsBillerID()
    {
        return $this->ConsolidatorsBillerID;
    }

    /**
     * @param AlphaNumIDType $ConsolidatorsBillerID
     */
    public function setConsolidatorsBillerID($ConsolidatorsBillerID): self
    {
        $this->ConsolidatorsBillerID = $ConsolidatorsBillerID;

        return $this;
    }

    /**
     * @return AlphaNumIDType
     */
    public function getInvoiceRecipientsBillerID()
    {
        return $this->InvoiceRecipientsBillerID;
    }

    /**
     * @param AlphaNumIDType $InvoiceRecipientsBillerID
     */
    public function setInvoiceRecipientsBillerID($InvoiceRecipientsBillerID): self
    {
        $this->InvoiceRecipientsBillerID = $InvoiceRecipientsBillerID;

        return $this;
    }

    public function getOrderReference(): OrderReferenceType
    {
        return $this->OrderReference;
    }

    public function setOrderReference(OrderReferenceType $OrderReference): self
    {
        $this->OrderReference = $OrderReference;

        return $this;
    }

    public function getAddress(): AddressType
    {
        return $this->Address;
    }

    public function setAddress(AddressType $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getBillerExtension(): BillerExtensionType
    {
        return $this->BillerExtension;
    }

    public function setBillerExtension(BillerExtensionType $BillerExtension): self
    {
        $this->BillerExtension = $BillerExtension;

        return $this;
    }
}
