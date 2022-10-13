<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class Recipient
{
    /**
     * @var string
     */
    protected $RecipientID = null;

    /**
     * @var RecipientType
     */
    protected $Recipient = null;

    /**
     * @param string        $RecipientID
     * @param RecipientType $Recipient
     */
    public function __construct($RecipientID, $Recipient)
    {
        $this->RecipientID = $RecipientID;
        $this->Recipient = $Recipient;
    }

    /**
     * @return string
     */
    public function getRecipientID()
    {
        return $this->RecipientID;
    }

    /**
     * @param string $RecipientID
     *
     * @return Recipient
     */
    public function setRecipientID($RecipientID)
    {
        $this->RecipientID = $RecipientID;

        return $this;
    }

    /**
     * @return RecipientType
     */
    public function getRecipient()
    {
        return $this->Recipient;
    }

    /**
     * @param RecipientType $Recipient
     *
     * @return Recipient
     */
    public function setRecipient($Recipient)
    {
        $this->Recipient = $Recipient;

        return $this;
    }
}
