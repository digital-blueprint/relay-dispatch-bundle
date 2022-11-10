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

    public function __construct(string $RecipientID, RecipientType $Recipient)
    {
        $this->RecipientID = $RecipientID;
        $this->Recipient = $Recipient;
    }

    public function getRecipientID(): string
    {
        return $this->RecipientID;
    }

    public function setRecipientID(string $RecipientID)
    {
        $this->RecipientID = $RecipientID;
    }

    public function getRecipient(): RecipientType
    {
        return $this->Recipient;
    }

    public function setRecipient(RecipientType $Recipient)
    {
        $this->Recipient = $Recipient;
    }
}
