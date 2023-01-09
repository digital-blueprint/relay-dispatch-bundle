<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData;

class PersonNameType
{
    /**
     * @var string
     */
    protected $GivenName = null;

    /**
     * @var FamilyName
     */
    protected $FamilyName = null;

    /**
     * @var ?string
     */
    protected $prefixTitle = null;

    /**
     * @var ?string
     */
    protected $postfixTitle = null;

    public function __construct(string $GivenName, FamilyName $FamilyName, ?string $prefixTitle = null, ?string $postfixTitle = null)
    {
        $this->GivenName = $GivenName;
        $this->FamilyName = $FamilyName;
        $this->prefixTitle = $prefixTitle;
        $this->postfixTitle = $postfixTitle;
    }

    public function getGivenName(): string
    {
        return $this->GivenName;
    }

    public function setGivenName(string $GivenName): void
    {
        $this->GivenName = $GivenName;
    }

    public function getFamilyName(): FamilyName
    {
        return $this->FamilyName;
    }

    public function setFamilyName(FamilyName $FamilyName): void
    {
        $this->FamilyName = $FamilyName;
    }

    public function getPrefixTitle(): ?string
    {
        return $this->prefixTitle;
    }

    public function setPrefixTitle($prefixTitle): void
    {
        $this->prefixTitle = $prefixTitle;
    }

    public function getPostfixTitle(): ?string
    {
        return $this->postfixTitle;
    }

    public function setPostfixTitle(string $postfixTitle): void
    {
        $this->postfixTitle = $postfixTitle;
    }
}
