<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PGPDataType
{
    /**
     * @var CryptoBinary
     */
    protected $PGPKeyID = null;

    /**
     * @var CryptoBinary
     */
    protected $PGPKeyPacket = null;

    /**
     * @var string
     */
    protected $any = null;

    /**
     * @param CryptoBinary $PGPKeyID
     * @param string       $any
     */
    public function __construct($PGPKeyID, $any)
    {
        $this->PGPKeyID = $PGPKeyID;
        $this->any = $any;
    }

    /**
     * @return CryptoBinary
     */
    public function getPGPKeyID()
    {
        return $this->PGPKeyID;
    }

    /**
     * @param CryptoBinary $PGPKeyID
     *
     * @return PGPDataType
     */
    public function setPGPKeyID($PGPKeyID)
    {
        $this->PGPKeyID = $PGPKeyID;

        return $this;
    }

    /**
     * @return CryptoBinary
     */
    public function getPGPKeyPacket()
    {
        return $this->PGPKeyPacket;
    }

    /**
     * @param CryptoBinary $PGPKeyPacket
     *
     * @return PGPDataType
     */
    public function setPGPKeyPacket($PGPKeyPacket)
    {
        $this->PGPKeyPacket = $PGPKeyPacket;

        return $this;
    }

    /**
     * @return string
     */
    public function getAny()
    {
        return $this->any;
    }

    /**
     * @param string $any
     *
     * @return PGPDataType
     */
    public function setAny($any)
    {
        $this->any = $any;

        return $this;
    }
}
