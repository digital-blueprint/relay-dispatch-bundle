<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class AddressType
{
    /**
     * @var AddressIdentifierType
     */
    protected $AddressIdentifier;

    /**
     * @var string
     */
    protected $Salutation;

    /**
     * @var string
     */
    protected $Name;

    /**
     * @var string
     */
    protected $Street;

    /**
     * @var string
     */
    protected $POBox;

    /**
     * @var string
     */
    protected $Town;

    /**
     * @var string
     */
    protected $ZIP;

    /**
     * @var CountryType
     */
    protected $Country;

    /**
     * @var string
     */
    protected $Phone;

    /**
     * @var string
     */
    protected $Email;

    /**
     * @var string
     */
    protected $Contact;

    /**
     * @var string
     */
    protected $AddressExtension;

    /**
     * @param AddressIdentifierType $AddressIdentifier
     * @param string                $Salutation
     * @param string                $Name
     * @param string                $Street
     * @param string                $POBox
     * @param string                $Town
     * @param string                $ZIP
     * @param CountryType           $Country
     * @param string                $Phone
     * @param string                $Email
     * @param string                $Contact
     * @param string                $AddressExtension
     */
    public function __construct($AddressIdentifier, $Salutation, $Name, $Street, $POBox, $Town, $ZIP, $Country, $Phone, $Email, $Contact, $AddressExtension)
    {
        $this->AddressIdentifier = $AddressIdentifier;
        $this->Salutation = $Salutation;
        $this->Name = $Name;
        $this->Street = $Street;
        $this->POBox = $POBox;
        $this->Town = $Town;
        $this->ZIP = $ZIP;
        $this->Country = $Country;
        $this->Phone = $Phone;
        $this->Email = $Email;
        $this->Contact = $Contact;
        $this->AddressExtension = $AddressExtension;
    }

    public function getAddressIdentifier(): AddressIdentifierType
    {
        return $this->AddressIdentifier;
    }

    public function setAddressIdentifier(AddressIdentifierType $AddressIdentifier): self
    {
        $this->AddressIdentifier = $AddressIdentifier;

        return $this;
    }

    public function getSalutation(): string
    {
        return $this->Salutation;
    }

    public function setSalutation(string $Salutation): self
    {
        $this->Salutation = $Salutation;

        return $this;
    }

    public function getName(): string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getStreet(): string
    {
        return $this->Street;
    }

    public function setStreet(string $Street): self
    {
        $this->Street = $Street;

        return $this;
    }

    public function getPOBox(): string
    {
        return $this->POBox;
    }

    public function setPOBox(string $POBox): self
    {
        $this->POBox = $POBox;

        return $this;
    }

    public function getTown(): string
    {
        return $this->Town;
    }

    public function setTown(string $Town): self
    {
        $this->Town = $Town;

        return $this;
    }

    public function getZIP(): string
    {
        return $this->ZIP;
    }

    public function setZIP(string $ZIP): self
    {
        $this->ZIP = $ZIP;

        return $this;
    }

    public function getCountry(): CountryType
    {
        return $this->Country;
    }

    public function setCountry(CountryType $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getContact(): string
    {
        return $this->Contact;
    }

    public function setContact(string $Contact): self
    {
        $this->Contact = $Contact;

        return $this;
    }

    public function getAddressExtension(): string
    {
        return $this->AddressExtension;
    }

    public function setAddressExtension(string $AddressExtension): self
    {
        $this->AddressExtension = $AddressExtension;

        return $this;
    }
}
