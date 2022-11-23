<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing;

class Recipients
{
    /**
     * @var Recipient[]
     */
    protected $Recipient = null;

    /**
     * @param Recipient[] $Recipient
     */
    public function __construct(array $Recipient)
    {
        $this->Recipient = $Recipient;
    }

    /**
     * @return Recipient[]
     */
    public function getRecipient(): array
    {
        return $this->Recipient;
    }

    /**
     * @param Recipient[] $Recipient
     */
    public function setRecipient(array $Recipient): void
    {
        $this->Recipient = $Recipient;
    }
}
