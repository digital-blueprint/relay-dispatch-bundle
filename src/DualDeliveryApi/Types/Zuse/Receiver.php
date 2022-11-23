<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class Receiver
{
    /**
     * @var ?PhysicalPersonType
     */
    protected $PhysicalPerson = null;

    /**
     * @var ?CorporateBodyType
     */
    protected $CorporateBody = null;

    /**
     * @var mixed
     */
    protected $MailBox = null;

    /**
     * @var ?PostalAddressType
     */
    protected $PostalAddress = null;

    /**
     * @param mixed $MailBox
     */
    public function __construct(?PhysicalPersonType $PhysicalPerson, ?CorporateBodyType $CorporateBody, $MailBox, ?PostalAddressType $PostalAddress)
    {
        $this->PhysicalPerson = $PhysicalPerson;
        $this->CorporateBody = $CorporateBody;
        $this->MailBox = $MailBox;
        $this->PostalAddress = $PostalAddress;
    }

    public function getPhysicalPerson(): ?PhysicalPersonType
    {
        return $this->PhysicalPerson;
    }

    public function setPhysicalPerson(PhysicalPersonType $PhysicalPerson): void
    {
        $this->PhysicalPerson = $PhysicalPerson;
    }

    public function getCorporateBody(): ?CorporateBodyType
    {
        return $this->CorporateBody;
    }

    public function setCorporateBody(CorporateBodyType $CorporateBody): void
    {
        $this->CorporateBody = $CorporateBody;
    }

    /**
     * @return mixed
     */
    public function getMailBox()
    {
        return $this->MailBox;
    }

    /**
     * @param mixed $MailBox
     */
    public function setMailBox($MailBox): void
    {
        $this->MailBox = $MailBox;
    }

    public function getPostalAddress(): ?PostalAddressType
    {
        return $this->PostalAddress;
    }

    public function setPostalAddress(PostalAddressType $PostalAddress): void
    {
        $this->PostalAddress = $PostalAddress;
    }
}
