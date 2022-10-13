<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class Payments
{
    /**
     * @var Payment
     */
    protected $Payment = null;

    /**
     * @param Payment $Payment
     */
    public function __construct($Payment)
    {
        $this->Payment = $Payment;
    }

    /**
     * @return Payment
     */
    public function getPayment()
    {
        return $this->Payment;
    }

    /**
     * @param Payment $Payment
     *
     * @return Payments
     */
    public function setPayment($Payment)
    {
        $this->Payment = $Payment;

        return $this;
    }
}
