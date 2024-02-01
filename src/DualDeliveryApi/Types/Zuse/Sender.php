<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class Sender
{
    /**
     * @var Organisation
     */
    protected $Organisation;

    /**
     * @var ?PhysicalPersonType
     */
    protected $PhysicalPerson;

    /**
     * @var ?CorporateBodyType
     */
    protected $CorporateBody;

    /**
     * @var ?string
     */
    protected $MailBox;

    /**
     * @var AbstractAddressType[]
     */
    protected $Address;

    /**
     * @param AbstractAddressType[] $Address
     */
    public function __construct(Organisation $Organisation, ?PhysicalPersonType $PhysicalPerson, ?CorporateBodyType $CorporateBody, ?string $MailBox, array $Address)
    {
        $this->Organisation = $Organisation;
        $this->PhysicalPerson = $PhysicalPerson;
        $this->CorporateBody = $CorporateBody;
        $this->MailBox = $MailBox;
        $this->Address = $Address;
    }

    public function getOrganisation(): ?Organisation
    {
        return $this->Organisation;
    }

    public function setOrganisation(Organisation $Organisation): void
    {
        $this->Organisation = $Organisation;
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

    public function getMailBox(): ?string
    {
        return $this->MailBox;
    }

    public function setMailBox(string $MailBox): void
    {
        $this->MailBox = $MailBox;
    }

    /**
     * @return AbstractAddressType[]
     */
    public function getAddress(): array
    {
        return $this->Address;
    }

    /**
     * @param AbstractAddressType[] $Address
     */
    public function setAddress(array $Address): void
    {
        $this->Address = $Address;
    }
}
