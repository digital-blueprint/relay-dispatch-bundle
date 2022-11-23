<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface\KeyInfoType;

class InternetAddressType extends AbstractAddressType
{
    /**
     * @var \Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig\KeyInfoType
     */
    protected $KeyInfo = null;

    /**
     * @var AnyURI
     */
    protected $Address = null;

    /**
     * @param string                                                              $Id
     * @param \Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig\KeyInfoType $KeyInfo
     * @param AnyURI                                                              $Address
     */
    public function __construct($Id, $KeyInfo, $Address)
    {
        parent::__construct($Id);
        $this->KeyInfo = $KeyInfo;
        $this->Address = $Address;
    }

    public function getKeyInfo(): KeyInfoType
    {
        return $this->KeyInfo;
    }

    public function setKeyInfo(KeyInfoType $KeyInfo): self
    {
        $this->KeyInfo = $KeyInfo;

        return $this;
    }

    public function getAddress(): AnyURI
    {
        return $this->Address;
    }

    public function setAddress(AnyURI $Address): self
    {
        $this->Address = $Address;

        return $this;
    }
}
