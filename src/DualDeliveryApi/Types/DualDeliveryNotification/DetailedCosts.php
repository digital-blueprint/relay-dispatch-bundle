<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

class DetailedCosts
{
    /**
     * @var ?float
     */
    protected $PrintingCosts;

    /**
     * @var ?float
     */
    protected $HandlingCosts;

    /**
     * @var ?float
     */
    protected $PostageCosts;

    public function __construct(?float $PrintingCosts, ?float $HandlingCosts, ?float $PostageCosts)
    {
        $this->PrintingCosts = $PrintingCosts;
        $this->HandlingCosts = $HandlingCosts;
        $this->PostageCosts = $PostageCosts;
    }

    public function getPrintingCosts(): ?float
    {
        return $this->PrintingCosts;
    }

    public function setPrintingCosts(float $PrintingCosts): void
    {
        $this->PrintingCosts = $PrintingCosts;
    }

    public function getHandlingCosts(): ?float
    {
        return $this->HandlingCosts;
    }

    public function setHandlingCosts(float $HandlingCosts): void
    {
        $this->HandlingCosts = $HandlingCosts;
    }

    public function getPostageCosts(): ?float
    {
        return $this->PostageCosts;
    }

    public function setPostageCosts(float $PostageCosts): void
    {
        $this->PostageCosts = $PostageCosts;
    }
}
