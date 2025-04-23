<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\CheckSumType;

class PaymentReferenceType
{
    /**
     * @var string
     */
    protected $_;

    /**
     * @var CheckSumType
     */
    protected $CheckSum;

    /**
     * @param string       $_
     * @param CheckSumType $CheckSum
     */
    public function __construct($_, $CheckSum)
    {
        $this->_ = $_;
        $this->CheckSum = $CheckSum;
    }

    /**
     * @return string
     */
    public function get_()
    {
        return $this->_;
    }

    /**
     * @param string $_
     */
    public function set_($_): self
    {
        $this->_ = $_;

        return $this;
    }

    /**
     * @return CheckSumType
     */
    public function getCheckSum()
    {
        return $this->CheckSum;
    }

    /**
     * @param CheckSumType $CheckSum
     */
    public function setCheckSum($CheckSum): self
    {
        $this->CheckSum = $CheckSum;

        return $this;
    }
}
