<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class PresentationDetailsType
{
    /**
     * @var string
     */
    protected $URL;

    /**
     * @var string
     */
    protected $LogoURL;

    /**
     * @var string
     */
    protected $LayoutID;

    /**
     * @var bool
     */
    protected $SuppressZero;

    /**
     * @var PresentationDetailsExtensionType
     */
    protected $PresentationDetailsExtension;

    /**
     * @param string                           $URL
     * @param string                           $LogoURL
     * @param string                           $LayoutID
     * @param bool                             $SuppressZero
     * @param PresentationDetailsExtensionType $PresentationDetailsExtension
     */
    public function __construct($URL, $LogoURL, $LayoutID, $SuppressZero, $PresentationDetailsExtension)
    {
        $this->URL = $URL;
        $this->LogoURL = $LogoURL;
        $this->LayoutID = $LayoutID;
        $this->SuppressZero = $SuppressZero;
        $this->PresentationDetailsExtension = $PresentationDetailsExtension;
    }

    public function getURL(): string
    {
        return $this->URL;
    }

    public function setURL(string $URL): self
    {
        $this->URL = $URL;

        return $this;
    }

    public function getLogoURL(): string
    {
        return $this->LogoURL;
    }

    public function setLogoURL(string $LogoURL): self
    {
        $this->LogoURL = $LogoURL;

        return $this;
    }

    /**
     * @return string
     */
    public function getLayoutID()
    {
        return $this->LayoutID;
    }

    /**
     * @param string $LayoutID
     */
    public function setLayoutID($LayoutID): self
    {
        $this->LayoutID = $LayoutID;

        return $this;
    }

    public function getSuppressZero(): bool
    {
        return $this->SuppressZero;
    }

    public function setSuppressZero(bool $SuppressZero): self
    {
        $this->SuppressZero = $SuppressZero;

        return $this;
    }

    public function getPresentationDetailsExtension(): PresentationDetailsExtensionType
    {
        return $this->PresentationDetailsExtension;
    }

    public function setPresentationDetailsExtension(PresentationDetailsExtensionType $PresentationDetailsExtension): self
    {
        $this->PresentationDetailsExtension = $PresentationDetailsExtension;

        return $this;
    }
}
