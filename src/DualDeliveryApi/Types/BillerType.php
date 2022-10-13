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

    /**
     * @return string
     */
    public function getVATIdentificationNumber()
    {
        return $this->VATIdentificationNumber;
    }

    /**
     * @param string $VATIdentificationNumber
     *
     * @return BillerType
     */
    public function setVATIdentificationNumber($VATIdentificationNumber)
    {
        $this->VATIdentificationNumber = $VATIdentificationNumber;

        return $this;
    }

    /**
     * @return FurtherIdentificationType
     */
    public function getFurtherIdentification()
    {
        return $this->FurtherIdentification;
    }

    /**
     * @param FurtherIdentificationType $FurtherIdentification
     *
     * @return BillerType
     */
    public function setFurtherIdentification($FurtherIdentification)
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
     *
     * @return BillerType
     */
    public function setConsolidatorsBillerID($ConsolidatorsBillerID)
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
     *
     * @return BillerType
     */
    public function setInvoiceRecipientsBillerID($InvoiceRecipientsBillerID)
    {
        $this->InvoiceRecipientsBillerID = $InvoiceRecipientsBillerID;

        return $this;
    }

    /**
     * @return OrderReferenceType
     */
    public function getOrderReference()
    {
        return $this->OrderReference;
    }

    /**
     * @param OrderReferenceType $OrderReference
     *
     * @return BillerType
     */
    public function setOrderReference($OrderReference)
    {
        $this->OrderReference = $OrderReference;

        return $this;
    }

    /**
     * @return AddressType
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * @param AddressType $Address
     *
     * @return BillerType
     */
    public function setAddress($Address)
    {
        $this->Address = $Address;

        return $this;
    }

    /**
     * @return BillerExtensionType
     */
    public function getBillerExtension()
    {
        return $this->BillerExtension;
    }

    /**
     * @param BillerExtensionType $BillerExtension
     *
     * @return BillerType
     */
    public function setBillerExtension($BillerExtension)
    {
        $this->BillerExtension = $BillerExtension;

        return $this;
    }
}
