<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="dispatch_request_status_changes")
 * @ApiResource(
 *     collectionOperations={
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/request-status-changes",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_SCOPE_DISPATCH')",
 *             "path" = "/dispatch/request-status-changes/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Dispatch"}
 *             },
 *         },
 *     },
 *     iri="https://schema.org/Status",
 *     shortName="DispatchRequestStatusChange",
 *     normalizationContext={
 *         "groups" = {"DispatchRequestStatusChange:output", "DispatchRequest:output"},
 *         "jsonld_embed_context" = true
 *     }
 * )
 */
class RequestStatusChange
{
    public const STATUS_SUBMITTED = 1;
    public const STATUS_IN_PROGRESS = 2;

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=50)
     * @ApiProperty(identifier=true)
     * @Groups({"DispatchRequestStatusChange:output", "DispatchRequest:output"})
     */
    private $identifier;

    /**
     * @ORM\Column(type="datetime")
     * @ApiProperty(iri="https://schema.org/dateCreated")
     * @Groups({"DispatchRequestStatusChange:output", "DispatchRequest:output"})
     *
     * @var \DateTimeInterface
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity="Request", inversedBy="statusChanges")
     * @ORM\JoinColumn(name="dispatch_request_identifier", referencedColumnName="identifier")
     * @ApiProperty
     * @Groups({"DispatchRequestStatusChange:output"})
     *
     * @var Request
     */
    private $request;

    /**
     * @ORM\Column(type="string", length=50)
     * @ApiProperty(iri="https://schema.org/identifier")
     * @Groups({"DispatchRequestStatusChange:output"})
     *
     * @var string
     */
    private $dispatchRequestIdentifier;

    /**
     * @ORM\Column(type="integer")
     * @ApiProperty(iri="https://schema.org/statusType")
     * @Groups({"DispatchRequestStatusChange:output", "DispatchRequest:output"})
     *
     * @var int
     */
    private $statusType;

    /**
     * @ORM\Column(type="text")
     * @ApiProperty(iri="https://schema.org/description")
     * @Groups({"DispatchRequestStatusChange:output", "DispatchRequest:output"})
     *
     * @var string
     */
    private $description;

    public function getIdentifier(): string
    {
        return (string) $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getDateCreated(): \DateTimeInterface
    {
        /** @var \DateTime $date */
        $date = $this->dateCreated;

        return $date->setTimezone(new \DateTimeZone('UTC'));
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    public function getDispatchRequest(): Request
    {
        return $this->request;
    }

    public function getDispatchRequestIdentifier(): string
    {
        return $this->dispatchRequestIdentifier;
    }

    public function setDispatchRequestIdentifier(string $dispatchRequestIdentifier): void
    {
        $this->dispatchRequestIdentifier = $dispatchRequestIdentifier;
    }

    public function getStatusType(): int
    {
        return $this->statusType;
    }

    public function setStatusType(int $statusType): void
    {
        $this->statusType = $statusType;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }
}
