<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get" = {
 *             "path" = "/dispatch/groups",
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             }
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "path" = "/dispatch/groups/{identifier}",
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"},
 *                 "parameters" = {
 *                     {"name" = "identifier", "in" = "path", "description" = "Resource identifier", "required" = true, "type" = "string", "example" = "1190"}
 *                 }
 *             }
 *         },
 *     },
 *     iri="http://schema.org/Organization",
 *     shortName="DispatchGroup",
 *     description="A group",
 *     normalizationContext={
 *         "jsonld_embed_context" = true,
 *         "groups" = {"DispatchGroup:output"}
 *     }
 * )
 */
class Group
{
    /**
     * @ApiProperty(identifier=true)
     * @Groups({"DispatchGroup:output"})
     *
     * @var string
     */
    private $identifier;

    /**
     * @ApiProperty(iri="https://schema.org/name")
     * @Groups({"DispatchGroup:output"})
     *
     * @var string
     */
    private $name;

    /**
     * @ApiProperty(iri="https://schema.org/streetAddress")
     * @Groups({"DispatchGroup:output"})
     *
     * @var string
     */
    private $street;

    /**
     * @ApiProperty(iri="https://schema.org/addressLocality")
     * @Groups({"DispatchGroup:output"})
     *
     * @var string
     */
    private $locality;

    /**
     * @ApiProperty(iri="https://schema.org/postalCode")
     * @Groups({"DispatchGroup:output"})
     *
     * @var string
     */
    private $postalCode;

    /**
     * @ApiProperty(iri="https://schema.org/addressCountry")
     * @Groups({"DispatchGroup:output"})
     *
     * @var string
     */
    private $country;

    /**
     * @ApiProperty
     * @Groups({"DispatchGroup:output"})
     *
     * @var bool
     */
    private $mayRead;

    /**
     * @ApiProperty
     * @Groups({"DispatchGroup:output"})
     *
     * @var bool
     */
    private $mayWrite;

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getLocality(): string
    {
        return $this->locality;
    }

    public function setLocality(string $locality): void
    {
        $this->locality = $locality;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getMayRead(): bool
    {
        return $this->mayRead;
    }

    public function setMayRead(bool $mayRead): void
    {
        $this->mayRead = $mayRead;
    }

    public function getMayWrite(): bool
    {
        return $this->mayWrite;
    }

    public function setMayWrite(bool $mayWrite): void
    {
        $this->mayWrite = $mayWrite;
    }
}
