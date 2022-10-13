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

    /**
     * @return AnyURI
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * @param AnyURI $URL
     *
     * @return DocumentReferenceType
     */
    public function setURL($URL)
    {
        $this->URL = $URL;

        return $this;
    }
}
