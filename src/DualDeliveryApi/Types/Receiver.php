<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return PhysicalPersonType
     */
    public function getPhysicalPerson()
    {
        return $this->PhysicalPerson;
    }

    /**
     * @param PhysicalPersonType $PhysicalPerson
     *
     * @return Receiver
     */
    public function setPhysicalPerson($PhysicalPerson)
    {
        $this->PhysicalPerson = $PhysicalPerson;

        return $this;
    }

    /**
     * @return CorporateBodyType
     */
    public function getCorporateBody()
    {
        return $this->CorporateBody;
    }

    /**
     * @param CorporateBodyType $CorporateBody
     *
     * @return Receiver
     */
    public function setCorporateBody($CorporateBody)
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
     *
     * @return Receiver
     */
    public function setMailBox($MailBox)
    {
        $this->MailBox = $MailBox;

        return $this;
    }

    /**
     * @return PostalAddressType
     */
    public function getPostalAddress()
    {
        return $this->PostalAddress;
    }

    /**
     * @param PostalAddressType $PostalAddress
     *
     * @return Receiver
     */
    public function setPostalAddress($PostalAddress)
    {
        $this->PostalAddress = $PostalAddress;

        return $this;
    }
}
