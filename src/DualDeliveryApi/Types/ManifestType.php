<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ManifestType
{
    /**
     * @var ReferenceType
     */
    protected $Reference = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param ReferenceType $Reference
     * @param string        $Id
     */
    public function __construct($Reference, $Id)
    {
        $this->Reference = $Reference;
        $this->Id = $Id;
    }

    public function getReference(): ReferenceType
    {
        return $this->Reference;
    }

    public function setReference(ReferenceType $Reference): self
    {
        $this->Reference = $Reference;

        return $this;
    }

    public function getId(): string
    {
        return $this->Id;
    }

    public function setId(string $Id): self
    {
        $this->Id = $Id;

        return $this;
    }
}
