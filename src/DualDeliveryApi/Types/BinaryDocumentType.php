<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class BinaryDocumentType extends DocumentType
{
    /**
     * @var string
     */
    protected $Content = null;

    /**
     * @param string $Content
     */
    public function __construct($Content)
    {
        $this->Content = $Content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->Content;
    }

    /**
     * @param string $Content
     *
     * @return BinaryDocumentType
     */
    public function setContent($Content)
    {
        $this->Content = $Content;

        return $this;
    }
}
