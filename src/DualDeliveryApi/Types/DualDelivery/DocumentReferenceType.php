<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class DocumentReferenceType extends DocumentType
{
    /**
     * @var string
     */
    protected $URL = null;

    public function __construct(string $URL)
    {
        $this->URL = $URL;
    }

    public function getURL(): string
    {
        return $this->URL;
    }

    public function setURL(string $URL): void
    {
        $this->URL = $URL;
    }
}
