<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData;

class AbstractAddressType
{
    /**
     * @var ?string
     */
    protected $Id;

    public function __construct(?string $Id)
    {
        $this->Id = $Id;
    }

    public function getId(): ?string
    {
        return $this->Id;
    }

    public function setId(string $Id): void
    {
        $this->Id = $Id;
    }
}
