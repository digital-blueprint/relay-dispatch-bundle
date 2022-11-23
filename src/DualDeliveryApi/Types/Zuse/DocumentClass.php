<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class DocumentClass
{
    /**
     * @var string
     */
    protected $Namespace = null;

    public function __construct(string $Namespace)
    {
        $this->Namespace = $Namespace;
    }

    public function getNamespace(): string
    {
        return $this->Namespace;
    }

    public function setNamespace(string $Namespace): void
    {
        $this->Namespace = $Namespace;
    }
}
