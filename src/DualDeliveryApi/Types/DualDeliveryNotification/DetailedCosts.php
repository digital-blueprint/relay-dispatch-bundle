<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

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

    public function getPrintingCosts(): float
    {
        return $this->PrintingCosts;
    }

    public function setPrintingCosts(float $PrintingCosts): self
    {
        $this->PrintingCosts = $PrintingCosts;

        return $this;
    }

    public function getHandlingCosts(): float
    {
        return $this->HandlingCosts;
    }

    public function setHandlingCosts(float $HandlingCosts): self
    {
        $this->HandlingCosts = $HandlingCosts;

        return $this;
    }

    public function getPostageCosts(): float
    {
        return $this->PostageCosts;
    }

    public function setPostageCosts(float $PostageCosts): self
    {
        $this->PostageCosts = $PostageCosts;

        return $this;
    }
}
