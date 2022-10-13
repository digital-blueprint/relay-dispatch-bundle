<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class InternetAddressType extends AbstractAddressType
{
    /**
     * @var KeyInfoType
     */
    protected $KeyInfo = null;

    /**
     * @var AnyURI
     */
    protected $Address = null;

    /**
     * @param string      $Id
     * @param KeyInfoType $KeyInfo
     * @param AnyURI      $Address
     */
    public function __construct($Id, $KeyInfo, $Address)
    {
        parent::__construct($Id);
        $this->KeyInfo = $KeyInfo;
        $this->Address = $Address;
    }

    /**
     * @return KeyInfoType
     */
    public function getKeyInfo()
    {
        return $this->KeyInfo;
    }

    /**
     * @param KeyInfoType $KeyInfo
     *
     * @return InternetAddressType
     */
    public function setKeyInfo($KeyInfo)
    {
        $this->KeyInfo = $KeyInfo;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * @param AnyURI $Address
     *
     * @return InternetAddressType
     */
    public function setAddress($Address)
    {
        $this->Address = $Address;

        return $this;
    }
}
