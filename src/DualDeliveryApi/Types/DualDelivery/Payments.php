<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class Payments
{
    /**
     * @var Payment[]
     */
    protected $Payment = null;

    /**
     * @param Payment[] $Payment
     */
    public function __construct(array $Payment)
    {
        $this->Payment = $Payment;
    }

    /**
     * @return Payment[]
     */
    public function getPayment(): array
    {
        return $this->Payment;
    }

    /**
     * @param Payment[] $Payment
     */
    public function setPayment(array $Payment): void
    {
        $this->Payment = $Payment;
    }
}
