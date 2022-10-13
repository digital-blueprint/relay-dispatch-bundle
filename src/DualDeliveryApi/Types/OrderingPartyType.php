<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class OrderingPartyType
{
    /**
     * @var string
     */
    protected $VATIdentificationNumber = null;

    /**
     * @var AlphaNumIDType
     */
    protected $BillersOrderingPartyID = null;

    /**
     * @var OrderReferenceType
     */
    protected $OrderReference = null;

    /**
     * @var AddressType
     */
    protected $Address = null;

    /**
     * @var OrderingPartyExtensionType
     */
    protected $OrderingPartyExtension = null;

    /**
     * @param string                     $VATIdentificationNumber
     * @param AlphaNumIDType             $BillersOrderingPartyID
     * @param OrderReferenceType         $OrderReference
     * @param AddressType                $Address
     * @param OrderingPartyExtensionType $OrderingPartyExtension
     */
    public function __construct($VATIdentificationNumber, $BillersOrderingPartyID, $OrderReference, $Address, $OrderingPartyExtension)
    {
        $this->VATIdentificationNumber = $VATIdentificationNumber;
        $this->BillersOrderingPartyID = $BillersOrderingPartyID;
        $this->OrderReference = $OrderReference;
        $this->Address = $Address;
        $this->OrderingPartyExtension = $OrderingPartyExtension;
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
     * @return OrderingPartyType
     */
    public function setVATIdentificationNumber($VATIdentificationNumber)
    {
        $this->VATIdentificationNumber = $VATIdentificationNumber;

        return $this;
    }

    /**
     * @return AlphaNumIDType
     */
    public function getBillersOrderingPartyID()
    {
        return $this->BillersOrderingPartyID;
    }

    /**
     * @param AlphaNumIDType $BillersOrderingPartyID
     *
     * @return OrderingPartyType
     */
    public function setBillersOrderingPartyID($BillersOrderingPartyID)
    {
        $this->BillersOrderingPartyID = $BillersOrderingPartyID;

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
     * @return OrderingPartyType
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
     * @return OrderingPartyType
     */
    public function setAddress($Address)
    {
        $this->Address = $Address;

        return $this;
    }

    /**
     * @return OrderingPartyExtensionType
     */
    public function getOrderingPartyExtension()
    {
        return $this->OrderingPartyExtension;
    }

    /**
     * @param OrderingPartyExtensionType $OrderingPartyExtension
     *
     * @return OrderingPartyType
     */
    public function setOrderingPartyExtension($OrderingPartyExtension)
    {
        $this->OrderingPartyExtension = $OrderingPartyExtension;

        return $this;
    }
}
