<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse\CorporateBodyType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse\PhysicalPersonType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse\PostalAddressType;

class Receiver
{
    /**
     * @var PhysicalPersonType
     */
    protected $PhysicalPerson = null;

    /**
     * @var CorporateBodyType
     */
    protected $CorporateBody = null;

    /**
     * @var mixed
     */
    protected $MailBox = null;

    /**
     * @var PostalAddressType
     */
    protected $PostalAddress = null;

    /**
     * @param PhysicalPersonType $PhysicalPerson
     * @param CorporateBodyType  $CorporateBody
     * @param mixed              $MailBox
     * @param PostalAddressType  $PostalAddress
     */
    public function __construct($PhysicalPerson, $CorporateBody, $MailBox, $PostalAddress)
    {
        $this->PhysicalPerson = $PhysicalPerson;
        $this->CorporateBody = $CorporateBody;
        $this->MailBox = $MailBox;
        $this->PostalAddress = $PostalAddress;
    }

    public function getPhysicalPerson(): PhysicalPersonType
    {
        return $this->PhysicalPerson;
    }

    public function setPhysicalPerson(PhysicalPersonType $PhysicalPerson): self
    {
        $this->PhysicalPerson = $PhysicalPerson;

        return $this;
    }

    public function getCorporateBody(): CorporateBodyType
    {
        return $this->CorporateBody;
    }

    public function setCorporateBody(CorporateBodyType $CorporateBody): self
    {
        $this->CorporateBody = $CorporateBody;

        return $this;
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
    public function setMailBox($MailBox): self
    {
        $this->MailBox = $MailBox;

        return $this;
    }

    public function getPostalAddress(): PostalAddressType
    {
        return $this->PostalAddress;
    }

    public function setPostalAddress(PostalAddressType $PostalAddress): self
    {
        $this->PostalAddress = $PostalAddress;

        return $this;
    }
}
