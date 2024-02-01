<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class SignatureValueType
{
    /**
     * @var CryptoBinary
     */
    protected $_;

    /**
     * @var string
     */
    protected $Id;

    /**
     * @param CryptoBinary $_
     * @param string       $Id
     */
    public function __construct($_, $Id)
    {
        $this->_ = $_;
        $this->Id = $Id;
    }

    public function get_(): CryptoBinary
    {
        return $this->_;
    }

    public function set_(CryptoBinary $_): self
    {
        $this->_ = $_;

        return $this;
    }

    public function getId(): string
    {
        return $this->Id;
    }

    public function setId(string $Id): self
    {
        $this->Id = $Id;

        return $this;
    }
}
