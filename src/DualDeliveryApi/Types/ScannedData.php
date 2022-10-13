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

    /**
     * @return BinaryDocument
     */
    public function getBinaryDocument()
    {
        return $this->BinaryDocument;
    }

    /**
     * @param BinaryDocument $BinaryDocument
     *
     * @return ScannedData
     */
    public function setBinaryDocument($BinaryDocument)
    {
        $this->BinaryDocument = $BinaryDocument;

        return $this;
    }

    /**
     * @return ExtensionPointType
     */
    public function getExtractedMetaData()
    {
        return $this->ExtractedMetaData;
    }

    /**
     * @param ExtensionPointType $ExtractedMetaData
     *
     * @return ScannedData
     */
    public function setExtractedMetaData($ExtractedMetaData)
    {
        $this->ExtractedMetaData = $ExtractedMetaData;

        return $this;
    }
}
