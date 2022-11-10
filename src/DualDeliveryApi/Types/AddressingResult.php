<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AddressingResult
{
    /**
     * @var UsedDeliveryChannelType[]
     */
    protected $DeliveryChannelAddressingResult = null;

    /**
     * @var string
     */
    protected $DualDeliveryID = null;

    /**
     * @var string
     */
    protected $RecipientID = null;

    /**
     * @param UsedDeliveryChannelType[] $DeliveryChannelAddressingResult
     * @param string                    $DualDeliveryID
     * @param string                    $RecipientID
     */
    public function __construct($DeliveryChannelAddressingResult, $DualDeliveryID, $RecipientID)
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
    public function setDeliveryChannelAddressingResult(array $DeliveryChannelAddressingResult): self
    {
        $this->DeliveryChannelAddressingResult = $DeliveryChannelAddressingResult;

        return $this;
    }

    public function getDualDeliveryID(): string
    {
        return $this->DualDeliveryID;
    }

    public function setDualDeliveryID(string $DualDeliveryID): self
    {
        $this->DualDeliveryID = $DualDeliveryID;

        return $this;
    }

    public function getRecipientID(): string
    {
        return $this->RecipientID;
    }

    public function setRecipientID(string $RecipientID): self
    {
        $this->RecipientID = $RecipientID;

        return $this;
    }
}
