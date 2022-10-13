<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DetailedCosts
{
    /**
     * @var float
     */
    protected $PrintingCosts = null;

    /**
     * @var float
     */
    protected $HandlingCosts = null;

    /**
     * @var float
     */
    protected $PostageCosts = null;

    /**
     * @param float $PrintingCosts
     * @param float $HandlingCosts
     * @param float $PostageCosts
     */
    public function __construct($PrintingCosts, $HandlingCosts, $PostageCosts)
    {
        $this->PrintingCosts = $PrintingCosts;
        $this->HandlingCosts = $HandlingCosts;
        $this->PostageCosts = $PostageCosts;
    }

    /**
     * @return float
     */
    public function getPrintingCosts()
    {
        return $this->PrintingCosts;
    }

    /**
     * @param float $PrintingCosts
     *
     * @return DetailedCosts
     */
    public function setPrintingCosts($PrintingCosts)
    {
        $this->PrintingCosts = $PrintingCosts;

        return $this;
    }

    /**
     * @return float
     */
    public function getHandlingCosts()
    {
        return $this->HandlingCosts;
    }

    /**
     * @param float $HandlingCosts
     *
     * @return DetailedCosts
     */
    public function setHandlingCosts($HandlingCosts)
    {
        $this->HandlingCosts = $HandlingCosts;

        return $this;
    }

    /**
     * @return float
     */
    public function getPostageCosts()
    {
        return $this->PostageCosts;
    }

    /**
     * @param float $PostageCosts
     *
     * @return DetailedCosts
     */
    public function setPostageCosts($PostageCosts)
    {
        $this->PostageCosts = $PostageCosts;

        return $this;
    }
}
