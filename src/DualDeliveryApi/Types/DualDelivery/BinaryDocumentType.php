<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class BinaryDocumentType extends DocumentType
{
    /**
     * @var string
     */
    protected $Content;

    public function __construct(string $Content)
    {
        $this->Content = $Content;
    }

    public function getContent(): string
    {
        return $this->Content;
    }

    public function setContent(string $Content): void
    {
        $this->Content = $Content;
    }
}
