<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

class DelivererInformation
{
    /**
     * @var string
     */
    protected $Deliverer = null;

    /**
     * @var string
     */
    protected $DelivererReference = null;

    /**
     * @param string $Deliverer
     * @param string $DelivererReference
     */
    public function __construct($Deliverer, $DelivererReference)
    {
        $this->Deliverer = $Deliverer;
        $this->DelivererReference = $DelivererReference;
    }

    public function getDeliverer(): string
    {
        return $this->Deliverer;
    }

    public function setDeliverer(string $Deliverer): self
    {
        $this->Deliverer = $Deliverer;

        return $this;
    }

    public function getDelivererReference(): string
    {
        return $this->DelivererReference;
    }

    public function setDelivererReference(string $DelivererReference): self
    {
        $this->DelivererReference = $DelivererReference;

        return $this;
    }
}
