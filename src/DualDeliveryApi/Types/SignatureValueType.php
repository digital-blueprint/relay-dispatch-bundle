<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class SignatureValueType
{
    /**
     * @var CryptoBinary
     */
    protected $_ = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param CryptoBinary $_
     * @param string       $Id
     */
    public function __construct($_, $Id)
    {
        $this->_ = $_;
        $this->Id = $Id;
    }

    /**
     * @return CryptoBinary
     */
    public function get_()
    {
        return $this->_;
    }

    /**
     * @param CryptoBinary $_
     *
     * @return SignatureValueType
     */
    public function set_($_)
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param string $Id
     *
     * @return SignatureValueType
     */
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }
}
