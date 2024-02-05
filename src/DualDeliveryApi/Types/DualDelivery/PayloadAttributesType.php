<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class PayloadAttributesType
{
    /**
     * @var ?string
     */
    protected $Id;

    /**
     * @var string
     */
    protected $FileName;

    /**
     * @var string
     */
    protected $MIMEType;

    /**
     * @var ?int
     */
    protected $Size;

    /**
     * @var ?int
     */
    protected $PageCount;

    /**
     * @var ?Checksum
     */
    protected $Checksum;

    /**
     * @var ?int
     */
    protected $Index;

    /**
     * @var ?ParametersType
     */
    protected $Parameters;

    /**
     * @var ?PrintParameter
     */
    protected $PrintParameter;

    public function __construct(string $FileName, string $MIMEType, ?ParametersType $Parameters = null, ?PrintParameter $PrintParameter = null)
    {
        $this->FileName = $FileName;
        $this->MIMEType = $MIMEType;
        $this->Parameters = $Parameters;
        $this->PrintParameter = $PrintParameter;
    }

    public function getId(): ?string
    {
        return $this->Id;
    }

    public function setId(string $Id): void
    {
        $this->Id = $Id;
    }

    public function getFileName(): string
    {
        return $this->FileName;
    }

    public function setFileName(string $FileName): void
    {
        $this->FileName = $FileName;
    }

    public function getMIMEType(): string
    {
        return $this->MIMEType;
    }

    public function setMIMEType(string $MIMEType): void
    {
        $this->MIMEType = $MIMEType;
    }

    public function getSize(): ?int
    {
        return $this->Size;
    }

    public function setSize(int $Size): void
    {
        $this->Size = $Size;
    }

    public function getPageCount(): ?int
    {
        return $this->PageCount;
    }

    public function setPageCount(int $PageCount): void
    {
        $this->PageCount = $PageCount;
    }

    public function getChecksum(): ?Checksum
    {
        return $this->Checksum;
    }

    public function setChecksum(Checksum $Checksum): void
    {
        $this->Checksum = $Checksum;
    }

    public function getIndex(): ?int
    {
        return $this->Index;
    }

    public function setIndex(int $Index): void
    {
        $this->Index = $Index;
    }

    public function getParameters(): ?ParametersType
    {
        return $this->Parameters;
    }

    public function setParameters(ParametersType $Parameters): void
    {
        $this->Parameters = $Parameters;
    }

    public function getPrintParameter(): ?PrintParameter
    {
        return $this->PrintParameter;
    }

    public function setPrintParameter(PrintParameter $PrintParameter): void
    {
        $this->PrintParameter = $PrintParameter;
    }
}
