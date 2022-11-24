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
     * @var ?string
     */
    protected $DelivererReference = null;

    public function __construct(string $Deliverer, ?string $DelivererReference)
    {
        $this->Deliverer = $Deliverer;
        $this->DelivererReference = $DelivererReference;
    }

    public function getDeliverer(): string
    {
        return $this->Deliverer;
    }

    public function setDeliverer(string $Deliverer): void
    {
        $this->Deliverer = $Deliverer;
    }

    public function getDelivererReference(): ?string
    {
        return $this->DelivererReference;
    }

    public function setDelivererReference(string $DelivererReference): void
    {
        $this->DelivererReference = $DelivererReference;
    }
}
