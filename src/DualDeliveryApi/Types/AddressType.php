<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AddressType
{
    /**
     * @var AddressIdentifierType
     */
    protected $AddressIdentifier = null;

    /**
     * @var string
     */
    protected $Salutation = null;

    /**
     * @var string
     */
    protected $Name = null;

    /**
     * @var string
     */
    protected $Street = null;

    /**
     * @var string
     */
    protected $POBox = null;

    /**
     * @var string
     */
    protected $Town = null;

    /**
     * @var string
     */
    protected $ZIP = null;

    /**
     * @var CountryType
     */
    protected $Country = null;

    /**
     * @var string
     */
    protected $Phone = null;

    /**
     * @var string
     */
    protected $Email = null;

    /**
     * @var string
     */
    protected $Contact = null;

    /**
     * @var string
     */
    protected $AddressExtension = null;

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

    /**
     * @return AddressIdentifierType
     */
    public function getAddressIdentifier()
    {
        return $this->AddressIdentifier;
    }

    /**
     * @param AddressIdentifierType $AddressIdentifier
     *
     * @return AddressType
     */
    public function setAddressIdentifier($AddressIdentifier)
    {
        $this->AddressIdentifier = $AddressIdentifier;

        return $this;
    }

    /**
     * @return string
     */
    public function getSalutation()
    {
        return $this->Salutation;
    }

    /**
     * @param string $Salutation
     *
     * @return AddressType
     */
    public function setSalutation($Salutation)
    {
        $this->Salutation = $Salutation;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     *
     * @return AddressType
     */
    public function setName($Name)
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->Street;
    }

    /**
     * @param string $Street
     *
     * @return AddressType
     */
    public function setStreet($Street)
    {
        $this->Street = $Street;

        return $this;
    }

    /**
     * @return string
     */
    public function getPOBox()
    {
        return $this->POBox;
    }

    /**
     * @param string $POBox
     *
     * @return AddressType
     */
    public function setPOBox($POBox)
    {
        $this->POBox = $POBox;

        return $this;
    }

    /**
     * @return string
     */
    public function getTown()
    {
        return $this->Town;
    }

    /**
     * @param string $Town
     *
     * @return AddressType
     */
    public function setTown($Town)
    {
        $this->Town = $Town;

        return $this;
    }

    /**
     * @return string
     */
    public function getZIP()
    {
        return $this->ZIP;
    }

    /**
     * @param string $ZIP
     *
     * @return AddressType
     */
    public function setZIP($ZIP)
    {
        $this->ZIP = $ZIP;

        return $this;
    }

    /**
     * @return CountryType
     */
    public function getCountry()
    {
        return $this->Country;
    }

    /**
     * @param CountryType $Country
     *
     * @return AddressType
     */
    public function setCountry($Country)
    {
        $this->Country = $Country;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->Phone;
    }

    /**
     * @param string $Phone
     *
     * @return AddressType
     */
    public function setPhone($Phone)
    {
        $this->Phone = $Phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param string $Email
     *
     * @return AddressType
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return $this->Contact;
    }

    /**
     * @param string $Contact
     *
     * @return AddressType
     */
    public function setContact($Contact)
    {
        $this->Contact = $Contact;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddressExtension()
    {
        return $this->AddressExtension;
    }

    /**
     * @param string $AddressExtension
     *
     * @return AddressType
     */
    public function setAddressExtension($AddressExtension)
    {
        $this->AddressExtension = $AddressExtension;

        return $this;
    }
}
