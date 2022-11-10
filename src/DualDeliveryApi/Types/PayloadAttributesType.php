<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PayloadAttributesType
{
    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @var string
     */
    protected $FileName = null;

    /**
     * @var string
     */
    protected $MIMEType = null;

    /**
     * @var int
     */
    protected $Size = null;

    /**
     * @var int
     */
    protected $PageCount = null;

    /**
     * @var Checksum
     */
    protected $Checksum = null;

    /**
     * @var int
     */
    protected $Index = null;

    /**
     * @var ParametersType
     */
    protected $Parameters = null;

    /**
     * @var PrintParameter
     */
    protected $PrintParameter = null;

    /**
     * @param string         $FileName
     * @param string         $MIMEType
     * @param ParametersType|null $Parameters
     * @param PrintParameter|null $PrintParameter
     */
    public function __construct($FileName, $MIMEType, $Parameters = null, $PrintParameter = null)
    {
        $this->FileName = $FileName;
        $this->MIMEType = $MIMEType;
        $this->Parameters = $Parameters;
        $this->PrintParameter = $PrintParameter;
    }

    public function getId(): string
    {
        return $this->Id;
    }

    public function setId(string $Id): self
    {
        $this->Id = $Id;

        return $this;
    }

    public function getFileName(): string
    {
        return $this->FileName;
    }

    public function setFileName(string $FileName): self
    {
        $this->FileName = $FileName;

        return $this;
    }

    public function getMIMEType(): string
    {
        return $this->MIMEType;
    }

    public function setMIMEType(string $MIMEType): self
    {
        $this->MIMEType = $MIMEType;

        return $this;
    }

    public function getSize(): int
    {
        return $this->Size;
    }

    public function setSize(int $Size): self
    {
        $this->Size = $Size;

        return $this;
    }

    public function getPageCount(): int
    {
        return $this->PageCount;
    }

    public function setPageCount(int $PageCount): self
    {
        $this->PageCount = $PageCount;

        return $this;
    }

    public function getChecksum(): Checksum
    {
        return $this->Checksum;
    }

    public function setChecksum(Checksum $Checksum): self
    {
        $this->Checksum = $Checksum;

        return $this;
    }

    public function getIndex(): int
    {
        return $this->Index;
    }

    public function setIndex(int $Index): self
    {
        $this->Index = $Index;

        return $this;
    }

    public function getParameters(): ParametersType
    {
        return $this->Parameters;
    }

    public function setParameters(ParametersType $Parameters): self
    {
        $this->Parameters = $Parameters;

        return $this;
    }

    public function getPrintParameter(): PrintParameter
    {
        return $this->PrintParameter;
    }

    public function setPrintParameter(PrintParameter $PrintParameter): self
    {
        $this->PrintParameter = $PrintParameter;

        return $this;
    }
}
