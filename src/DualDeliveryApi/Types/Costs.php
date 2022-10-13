<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return float
     */
    public function getTotalCosts()
    {
        return $this->TotalCosts;
    }

    /**
     * @param float $TotalCosts
     *
     * @return Costs
     */
    public function setTotalCosts($TotalCosts)
    {
        $this->TotalCosts = $TotalCosts;

        return $this;
    }

    /**
     * @return DetailedCosts
     */
    public function getDetailedCosts()
    {
        return $this->DetailedCosts;
    }

    /**
     * @param DetailedCosts $DetailedCosts
     *
     * @return Costs
     */
    public function setDetailedCosts($DetailedCosts)
    {
        $this->DetailedCosts = $DetailedCosts;

        return $this;
    }
}
