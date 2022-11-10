<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AbstractPersonType
{
    /**
     * @var string
     */
    protected $AbstractSimpleIdentification = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param string $AbstractSimpleIdentification
     * @param string $Id
     */
    public function __construct($AbstractSimpleIdentification = null, $Id = null)
    {
        $this->AbstractSimpleIdentification = $AbstractSimpleIdentification;
        $this->Id = $Id;
    }

    public function getAbstractSimpleIdentification(): string
    {
        return $this->AbstractSimpleIdentification;
    }

    public function setAbstractSimpleIdentification(string $AbstractSimpleIdentification): self
    {
        $this->AbstractSimpleIdentification = $AbstractSimpleIdentification;

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
