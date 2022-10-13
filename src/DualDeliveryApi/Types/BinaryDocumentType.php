<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class BinaryDocumentType extends DocumentType
{
    /**
     * @var base64Binary
     */
    protected $Content = null;

    /**
     * @param base64Binary $Content
     */
    public function __construct($Content)
    {
        $this->Content = $Content;
    }

    /**
     * @return base64Binary
     */
    public function getContent()
    {
        return $this->Content;
    }

    /**
     * @param base64Binary $Content
     *
     * @return BinaryDocumentType
     */
    public function setContent($Content)
    {
        $this->Content = $Content;

        return $this;
    }
}
