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
    public function getDeliveryChannelAddressingResult()
    {
        return $this->DeliveryChannelAddressingResult ?? [];
    }

    /**
     * @param UsedDeliveryChannelType[] $DeliveryChannelAddressingResult
     *
     * @return AddressingResult
     */
    public function setDeliveryChannelAddressingResult($DeliveryChannelAddressingResult)
    {
        $this->DeliveryChannelAddressingResult = $DeliveryChannelAddressingResult;

        return $this;
    }

    /**
     * @return string
     */
    public function getDualDeliveryID()
    {
        return $this->DualDeliveryID;
    }

    /**
     * @param string $DualDeliveryID
     *
     * @return AddressingResult
     */
    public function setDualDeliveryID($DualDeliveryID)
    {
        $this->DualDeliveryID = $DualDeliveryID;

        return $this;
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
     * @return AddressingResult
     */
    public function setRecipientID($RecipientID)
    {
        $this->RecipientID = $RecipientID;

        return $this;
    }
}
