<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PaymentReferenceType
{
    /**
     * @var Digit12Type
     */
    protected $_ = null;

    /**
     * @var CheckSumType
     */
    protected $CheckSum = null;

    /**
     * @param Digit12Type  $_
     * @param CheckSumType $CheckSum
     */
    public function __construct($_, $CheckSum)
    {
        $this->_ = $_;
        $this->CheckSum = $CheckSum;
    }

    /**
     * @return Digit12Type
     */
    public function get_()
    {
        return $this->_;
    }

    /**
     * @param Digit12Type $_
     *
     * @return PaymentReferenceType
     */
    public function set_($_)
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
     *
     * @return PaymentReferenceType
     */
    public function setCheckSum($CheckSum)
    {
        $this->CheckSum = $CheckSum;

        return $this;
    }
}
