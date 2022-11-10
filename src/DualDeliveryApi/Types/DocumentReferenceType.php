<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DocumentReferenceType extends DocumentType
{
    /**
     * @var AnyURI
     */
    protected $URL = null;

    /**
     * @param AnyURI $URL
     */
    public function __construct($URL)
    {
        $this->URL = $URL;
    }

    public function getURL(): AnyURI
    {
        return $this->URL;
    }

    public function setURL(AnyURI $URL): self
    {
        $this->URL = $URL;

        return $this;
    }
}
