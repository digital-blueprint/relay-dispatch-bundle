<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

class Costs
{
    /**
     * @var float
     */
    protected $TotalCosts = null;

    /**
     * @var DetailedCosts
     */
    protected $DetailedCosts = null;

    /**
     * @param float         $TotalCosts
     * @param DetailedCosts $DetailedCosts
     */
    public function __construct($TotalCosts, $DetailedCosts)
    {
        $this->TotalCosts = $TotalCosts;
        $this->DetailedCosts = $DetailedCosts;
    }

    public function getTotalCosts(): float
    {
        return $this->TotalCosts;
    }

    public function setTotalCosts(float $TotalCosts): self
    {
        $this->TotalCosts = $TotalCosts;

        return $this;
    }

    public function getDetailedCosts(): DetailedCosts
    {
        return $this->DetailedCosts;
    }

    public function setDetailedCosts(DetailedCosts $DetailedCosts): self
    {
        $this->DetailedCosts = $DetailedCosts;

        return $this;
    }
}
