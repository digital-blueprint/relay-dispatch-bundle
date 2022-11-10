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

    public function getPayment(): Payment
    {
        return $this->Payment;
    }

    public function setPayment(Payment $Payment): self
    {
        $this->Payment = $Payment;

        return $this;
    }
}
