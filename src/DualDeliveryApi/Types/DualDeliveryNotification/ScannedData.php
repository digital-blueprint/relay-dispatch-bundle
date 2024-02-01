<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ExtensionPointType;

class ScannedData
{
    /**
     * @var BinaryDocument
     */
    protected $BinaryDocument;

    /**
     * @var ExtensionPointType
     */
    protected $ExtractedMetaData;

    public function __construct(?BinaryDocument $BinaryDocument, ?ExtensionPointType $ExtractedMetaData)
    {
        $this->BinaryDocument = $BinaryDocument;
        $this->ExtractedMetaData = $ExtractedMetaData;
    }

    public function getBinaryDocument(): ?BinaryDocument
    {
        return $this->BinaryDocument;
    }

    public function setBinaryDocument(BinaryDocument $BinaryDocument): void
    {
        $this->BinaryDocument = $BinaryDocument;
    }

    public function getExtractedMetaData(): ?ExtensionPointType
    {
        return $this->ExtractedMetaData;
    }

    public function setExtractedMetaData(ExtensionPointType $ExtractedMetaData): void
    {
        $this->ExtractedMetaData = $ExtractedMetaData;
    }
}
