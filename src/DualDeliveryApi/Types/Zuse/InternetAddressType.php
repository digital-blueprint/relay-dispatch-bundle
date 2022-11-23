<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig\KeyInfoType;

class InternetAddressType extends AbstractAddressType
{
    /**
     * @var ?KeyInfoType
     */
    protected $KeyInfo = null;

    /**
     * @var string
     */
    protected $Address = null;

    public function __construct(string $Id, ?KeyInfoType $KeyInfo, string $Address)
    {
        parent::__construct($Id);
        $this->KeyInfo = $KeyInfo;
        $this->Address = $Address;
    }

    public function getKeyInfo(): ?KeyInfoType
    {
        return $this->KeyInfo;
    }

    public function setKeyInfo(KeyInfoType $KeyInfo): void
    {
        $this->KeyInfo = $KeyInfo;
    }

    public function getAddress(): string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): void
    {
        $this->Address = $Address;
    }
}
