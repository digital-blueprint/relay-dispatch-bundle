<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData;

class AbstractPersonType
{
    /**
     * @var IdentificationType[]
     */
    protected $Identification;

    /**
     * @var ?string
     */
    protected $Id;

    public function __construct(?string $Id = null)
    {
        $this->Id = $Id;
    }

    /**
     * @return IdentificationType[]
     */
    public function getIdentification(): array
    {
        return $this->Identification;
    }

    /**
     * @param IdentificationType[] $Identification
     */
    public function setIdentification(array $Identification): void
    {
        $this->Identification = $Identification;
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
