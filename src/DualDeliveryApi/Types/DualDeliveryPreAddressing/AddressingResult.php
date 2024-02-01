<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPreAddressing;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\UsedDeliveryChannelType;

class AddressingResult
{
    /**
     * @var UsedDeliveryChannelType[]
     */
    protected $DeliveryChannelAddressingResult;

    /**
     * @var ?string
     */
    protected $DualDeliveryID;

    /**
     * @var string
     */
    protected $RecipientID;

    /**
     * @param UsedDeliveryChannelType[] $DeliveryChannelAddressingResult
     */
    public function __construct(array $DeliveryChannelAddressingResult, ?string $DualDeliveryID, string $RecipientID)
    {
        $this->DeliveryChannelAddressingResult = $DeliveryChannelAddressingResult;
        $this->DualDeliveryID = $DualDeliveryID;
        $this->RecipientID = $RecipientID;
    }

    /**
     * @return UsedDeliveryChannelType[]
     */
    public function getDeliveryChannelAddressingResult(): array
    {
        return $this->DeliveryChannelAddressingResult ?? [];
    }

    /**
     * @param UsedDeliveryChannelType[] $DeliveryChannelAddressingResult
     */
    public function setDeliveryChannelAddressingResult(array $DeliveryChannelAddressingResult): void
    {
        $this->DeliveryChannelAddressingResult = $DeliveryChannelAddressingResult;
    }

    public function getDualDeliveryID(): ?string
    {
        return $this->DualDeliveryID;
    }

    public function setDualDeliveryID(string $DualDeliveryID): void
    {
        $this->DualDeliveryID = $DualDeliveryID;
    }

    public function getRecipientID(): string
    {
        return $this->RecipientID;
    }

    public function setRecipientID(string $RecipientID): void
    {
        $this->RecipientID = $RecipientID;
    }
}
