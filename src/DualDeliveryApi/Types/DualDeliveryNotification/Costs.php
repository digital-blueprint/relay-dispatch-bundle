<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

class Costs
{
    /**
     * @var float
     */
    protected $TotalCosts;

    /**
     * @var DetailedCosts
     */
    protected $DetailedCosts;

    public function __construct(float $TotalCosts, DetailedCosts $DetailedCosts)
    {
        $this->TotalCosts = $TotalCosts;
        $this->DetailedCosts = $DetailedCosts;
    }

    public function getTotalCosts(): float
    {
        return $this->TotalCosts;
    }

    public function setTotalCosts(float $TotalCosts): void
    {
        $this->TotalCosts = $TotalCosts;
    }

    public function getDetailedCosts(): DetailedCosts
    {
        return $this->DetailedCosts;
    }

    public function setDetailedCosts(DetailedCosts $DetailedCosts): void
    {
        $this->DetailedCosts = $DetailedCosts;
    }
}
