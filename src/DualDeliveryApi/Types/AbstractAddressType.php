<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AbstractAddressType
{
    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param string $Id
     */
    public function __construct($Id)
    {
        $this->Id = $Id;
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
