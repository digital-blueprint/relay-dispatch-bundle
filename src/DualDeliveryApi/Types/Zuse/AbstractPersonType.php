<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class AbstractPersonType
{
    /**
     * @var ?string
     */
    protected $AbstractSimpleIdentification;

    /**
     * @var ?string
     */
    protected $Id;

    public function __construct(?string $AbstractSimpleIdentification = null, ?string $Id = null)
    {
        $this->AbstractSimpleIdentification = $AbstractSimpleIdentification;
        $this->Id = $Id;
    }

    public function getAbstractSimpleIdentification(): ?string
    {
        return $this->AbstractSimpleIdentification;
    }

    public function setAbstractSimpleIdentification(string $AbstractSimpleIdentification): void
    {
        $this->AbstractSimpleIdentification = $AbstractSimpleIdentification;
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
