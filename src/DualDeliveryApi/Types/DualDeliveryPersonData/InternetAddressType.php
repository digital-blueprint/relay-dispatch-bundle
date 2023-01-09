<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData;

class InternetAddressType extends AbstractAddressType
{
    /**
     * @var ?string
     */
    protected $Address = null;

    /**
     * @var ?bool
     */
    protected $ReplyToAddress = null;

    public function __construct(string $Id, ?string $Address, ?bool $ReplyToAddress)
    {
        parent::__construct($Id);
        $this->Address = $Address;
        $this->ReplyToAddress = $ReplyToAddress;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): void
    {
        $this->Address = $Address;
    }

    public function getReplyToAddress(): ?bool
    {
        return $this->ReplyToAddress;
    }

    public function setReplyToAddress(bool $ReplyToAddress): void
    {
        $this->ReplyToAddress = $ReplyToAddress;
    }
}
