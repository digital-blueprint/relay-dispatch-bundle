<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class InvoiceRecipientType
{
    /**
     * @var string
     */
    protected $VATIdentificationNumber;

    /**
     * @var string
     */
    protected $BillersInvoiceRecipientID;

    /**
     * @var AccountingAreaType
     */
    protected $AccountingArea;

    /**
     * @var string
     */
    protected $SubOrganizationID;

    /**
     * @var OrderReferenceType
     */
    protected $OrderReference;

    /**
     * @var AddressType
     */
    protected $Address;

    /**
     * @var InvoiceRecipientExtensionType
     */
    protected $InvoiceRecipientExtension;

    /**
     * @param string                        $VATIdentificationNumber
     * @param string                        $BillersInvoiceRecipientID
     * @param AccountingAreaType            $AccountingArea
     * @param string                        $SubOrganizationID
     * @param OrderReferenceType            $OrderReference
     * @param AddressType                   $Address
     * @param InvoiceRecipientExtensionType $InvoiceRecipientExtension
     */
    public function __construct($VATIdentificationNumber, $BillersInvoiceRecipientID, $AccountingArea, $SubOrganizationID, $OrderReference, $Address, $InvoiceRecipientExtension)
    {
        $this->VATIdentificationNumber = $VATIdentificationNumber;
        $this->BillersInvoiceRecipientID = $BillersInvoiceRecipientID;
        $this->AccountingArea = $AccountingArea;
        $this->SubOrganizationID = $SubOrganizationID;
        $this->OrderReference = $OrderReference;
        $this->Address = $Address;
        $this->InvoiceRecipientExtension = $InvoiceRecipientExtension;
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

    /**
     * @return string
     */
    public function getBillersInvoiceRecipientID()
    {
        return $this->BillersInvoiceRecipientID;
    }

    /**
     * @param string $BillersInvoiceRecipientID
     */
    public function setBillersInvoiceRecipientID($BillersInvoiceRecipientID): self
    {
        $this->BillersInvoiceRecipientID = $BillersInvoiceRecipientID;

        return $this;
    }

    /**
     * @return AccountingAreaType
     */
    public function getAccountingArea()
    {
        return $this->AccountingArea;
    }

    /**
     * @param AccountingAreaType $AccountingArea
     */
    public function setAccountingArea($AccountingArea): self
    {
        $this->AccountingArea = $AccountingArea;

        return $this;
    }

    public function getSubOrganizationID(): string
    {
        return $this->SubOrganizationID;
    }

    public function setSubOrganizationID(string $SubOrganizationID): self
    {
        $this->SubOrganizationID = $SubOrganizationID;

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

    public function getInvoiceRecipientExtension(): InvoiceRecipientExtensionType
    {
        return $this->InvoiceRecipientExtension;
    }

    public function setInvoiceRecipientExtension(InvoiceRecipientExtensionType $InvoiceRecipientExtension): self
    {
        $this->InvoiceRecipientExtension = $InvoiceRecipientExtension;

        return $this;
    }
}
