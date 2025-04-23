<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class OrderingPartyType
{
    /**
     * @var string
     */
    protected $VATIdentificationNumber;

    /**
     * @var string
     */
    protected $BillersOrderingPartyID;

    /**
     * @var OrderReferenceType
     */
    protected $OrderReference;

    /**
     * @var AddressType
     */
    protected $Address;

    /**
     * @var OrderingPartyExtensionType
     */
    protected $OrderingPartyExtension;

    /**
     * @param string                     $VATIdentificationNumber
     * @param string                     $BillersOrderingPartyID
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
     * @return string
     */
    public function getBillersOrderingPartyID()
    {
        return $this->BillersOrderingPartyID;
    }

    /**
     * @param string $BillersOrderingPartyID
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
