<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DocumentClass
{
    /**
     * @var AnyURI
     */
    protected $Namespace = null;

    /**
     * @param AnyURI $Namespace
     */
    public function __construct($Namespace)
    {
        $this->Namespace = $Namespace;
    }

    public function getNamespace(): AnyURI
    {
        return $this->Namespace;
    }

    public function setNamespace(AnyURI $Namespace): self
    {
        $this->Namespace = $Namespace;

        return $this;
    }
}
