<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

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
 *                                 "requests": [
 *                                     {
 *                                       "givenName": "Max",
 *                                       "familyName": "Mustermann",
 *                                       "birthDate": "1980-01-01"
 *                                     }
 *                                 ]
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
     * @Groups({"DispatchPreAddressingRequest:output"})
     */
    private $recipients;

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

    public function getRecipients()
    {
        return $this->recipients;
    }
}
