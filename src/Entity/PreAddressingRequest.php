<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "post" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/pre-addressing-requests",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"},
 *                 "requestBody" = {
 *                     "content" = {
 *                         "application/json" = {
 *                             "schema" = {"type" = "object"},
 *                             "example" = {
 *                                 "givenName" = "Max",
 *                                 "familyName" = "Mustermann",
 *                                 "birthDate" = "1980-01-01"
 *                             },
 *                         }
 *                     }
 *                 },
 *             }
 *         },
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/pre-addressing-requests",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/pre-addressing-requests/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         },
 *     },
 *     iri="https://schema.org/Action",
 *     shortName="DispatchPreAddressingRequest",
 *     normalizationContext={
 *         "groups" = {"DispatchPreAddressingRequest:output"},
 *         "jsonld_embed_context" = true
 *     },
 *     denormalizationContext={
 *         "groups" = {"DispatchPreAddressingRequest:input"},
 *         "jsonld_embed_context" = true
 *     }
 * )
 */
class PreAddressingRequest
{
    /**
     * @ApiProperty(identifier=true)
     * @Groups({"DispatchPreAddressingRequest:output"})
     */
    private $identifier;

    /**
     * @ApiProperty(iri="https://schema.org/givenName")
     * @Groups({"DispatchPreAddressingRequest:output", "DispatchPreAddressingRequest:input", "DispatchRequest:output"})
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var string
     */
    private $givenName;

    /**
     * @ApiProperty(iri="https://schema.org/familyName")
     * @Groups({"DispatchPreAddressingRequest:output", "DispatchPreAddressingRequest:input", "DispatchRequest:output"})
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var string
     */
    private $familyName;

    /**
     * @ApiProperty(iri="http://schema.org/birthDate")
     * @Groups({"DispatchPreAddressingRequest:output", "DispatchPreAddressingRequest:input"})
     * I could not find an Assert that doesn't cause an error to do proper checks
     * @Assert\NotBlank
     *
     * @var \DateTimeInterface
     */
    private $birthDate;

    public function __construct()
    {
//        $this->recipients = new ArrayCollection();
    }

    public function getIdentifier(): string
    {
        return (string) $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    public function setGivenName(string $givenName): void
    {
        $this->givenName = $givenName;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setFamilyName(string $familyName): void
    {
        $this->familyName = $familyName;
    }

    public function getBirthDate(): \DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): void
    {
        $this->birthDate = $birthDate;
    }
}
