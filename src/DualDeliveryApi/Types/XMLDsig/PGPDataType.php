<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class PGPDataType
{
    /**
     * @var CryptoBinary
     */
    protected $PGPKeyID;

    /**
     * @var CryptoBinary
     */
    protected $PGPKeyPacket;

    /**
     * @var string
     */
    protected $any;

    /**
     * @param CryptoBinary $PGPKeyID
     * @param string       $any
     */
    public function __construct($PGPKeyID, $any)
    {
        $this->PGPKeyID = $PGPKeyID;
        $this->any = $any;
    }

    public function getPGPKeyID(): CryptoBinary
    {
        return $this->PGPKeyID;
    }

    public function setPGPKeyID(CryptoBinary $PGPKeyID): self
    {
        $this->PGPKeyID = $PGPKeyID;

        return $this;
    }

    public function getPGPKeyPacket(): CryptoBinary
    {
        return $this->PGPKeyPacket;
    }

    public function setPGPKeyPacket(CryptoBinary $PGPKeyPacket): self
    {
        $this->PGPKeyPacket = $PGPKeyPacket;

        return $this;
    }

    public function getAny(): string
    {
        return $this->any;
    }

    public function setAny(string $any): self
    {
        $this->any = $any;

        return $this;
    }
}
