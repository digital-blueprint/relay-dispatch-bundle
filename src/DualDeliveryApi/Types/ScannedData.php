<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ScannedData
{
    /**
     * @var BinaryDocument
     */
    protected $BinaryDocument = null;

    /**
     * @var ExtensionPointType
     */
    protected $ExtractedMetaData = null;

    /**
     * @param BinaryDocument     $BinaryDocument
     * @param ExtensionPointType $ExtractedMetaData
     */
    public function __construct($BinaryDocument, $ExtractedMetaData)
    {
        $this->BinaryDocument = $BinaryDocument;
        $this->ExtractedMetaData = $ExtractedMetaData;
    }

    public function getBinaryDocument(): BinaryDocument
    {
        return $this->BinaryDocument;
    }

    public function setBinaryDocument(BinaryDocument $BinaryDocument): self
    {
        $this->BinaryDocument = $BinaryDocument;

        return $this;
    }

    public function getExtractedMetaData(): ExtensionPointType
    {
        return $this->ExtractedMetaData;
    }

    public function setExtractedMetaData(ExtensionPointType $ExtractedMetaData): self
    {
        $this->ExtractedMetaData = $ExtractedMetaData;

        return $this;
    }
}
