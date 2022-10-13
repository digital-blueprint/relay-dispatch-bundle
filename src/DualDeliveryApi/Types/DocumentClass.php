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

    /**
     * @return AnyURI
     */
    public function getNamespace()
    {
        return $this->Namespace;
    }

    /**
     * @param AnyURI $Namespace
     *
     * @return DocumentClass
     */
    public function setNamespace($Namespace)
    {
        $this->Namespace = $Namespace;

        return $this;
    }
}
