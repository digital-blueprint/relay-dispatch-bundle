<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\RecipientType;

class Recipient
{
    /**
     * @var string
     */
    protected $RecipientID;

    /**
     * @var RecipientType
     */
    protected $Recipient;

    public function __construct(?string $RecipientID, RecipientType $Recipient)
    {
        $this->RecipientID = $RecipientID;
        $this->Recipient = $Recipient;
    }

    public function getRecipientID(): string
    {
        return $this->RecipientID;
    }

    public function setRecipientID(string $RecipientID): void
    {
        $this->RecipientID = $RecipientID;
    }

    public function getRecipient(): RecipientType
    {
        return $this->Recipient;
    }

    public function setRecipient(RecipientType $Recipient): void
    {
        $this->Recipient = $Recipient;
    }
}
