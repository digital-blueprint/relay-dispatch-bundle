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
     * @return AlphaNumIDType
     */
    public function getBillersOrderingPartyID()
    {
        return $this->BillersOrderingPartyID;
    }

    /**
     * @param AlphaNumIDType $BillersOrderingPartyID
     */
    public function setBillersOrderingPartyID($BillersOrderingPartyID): self
    {
        $this->BillersOrderingPartyID = $BillersOrderingPartyID;

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

    public function getOrderingPartyExtension(): OrderingPartyExtensionType
    {
        return $this->OrderingPartyExtension;
    }

    public function setOrderingPartyExtension(OrderingPartyExtensionType $OrderingPartyExtension): self
    {
        $this->OrderingPartyExtension = $OrderingPartyExtension;

        return $this;
    }
}
