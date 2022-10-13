<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class InvoiceRecipientType
{
    /**
     * @var string
     */
    protected $VATIdentificationNumber = null;

    /**
     * @var AlphaNumIDType
     */
    protected $BillersInvoiceRecipientID = null;

    /**
     * @var AccountingAreaType
     */
    protected $AccountingArea = null;

    /**
     * @var string
     */
    protected $SubOrganizationID = null;

    /**
     * @var OrderReferenceType
     */
    protected $OrderReference = null;

    /**
     * @var AddressType
     */
    protected $Address = null;

    /**
     * @var InvoiceRecipientExtensionType
     */
    protected $InvoiceRecipientExtension = null;

    /**
     * @param string                        $VATIdentificationNumber
     * @param AlphaNumIDType                $BillersInvoiceRecipientID
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
     * @return InvoiceRecipientType
     */
    public function setVATIdentificationNumber($VATIdentificationNumber)
    {
        $this->VATIdentificationNumber = $VATIdentificationNumber;

        return $this;
    }

    /**
     * @return AlphaNumIDType
     */
    public function getBillersInvoiceRecipientID()
    {
        return $this->BillersInvoiceRecipientID;
    }

    /**
     * @param AlphaNumIDType $BillersInvoiceRecipientID
     *
     * @return InvoiceRecipientType
     */
    public function setBillersInvoiceRecipientID($BillersInvoiceRecipientID)
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
     *
     * @return InvoiceRecipientType
     */
    public function setAccountingArea($AccountingArea)
    {
        $this->AccountingArea = $AccountingArea;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubOrganizationID()
    {
        return $this->SubOrganizationID;
    }

    /**
     * @param string $SubOrganizationID
     *
     * @return InvoiceRecipientType
     */
    public function setSubOrganizationID($SubOrganizationID)
    {
        $this->SubOrganizationID = $SubOrganizationID;

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
     * @return InvoiceRecipientType
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
     * @return InvoiceRecipientType
     */
    public function setAddress($Address)
    {
        $this->Address = $Address;

        return $this;
    }

    /**
     * @return InvoiceRecipientExtensionType
     */
    public function getInvoiceRecipientExtension()
    {
        return $this->InvoiceRecipientExtension;
    }

    /**
     * @param InvoiceRecipientExtensionType $InvoiceRecipientExtension
     *
     * @return InvoiceRecipientType
     */
    public function setInvoiceRecipientExtension($InvoiceRecipientExtension)
    {
        $this->InvoiceRecipientExtension = $InvoiceRecipientExtension;

        return $this;
    }
}
