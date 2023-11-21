<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dispatch_requests")
 */
class Request
{
    /**
     * @ORM\Id
     *
     * @ORM\Column(type="string", length=50)
     *
     * @Groups({"DispatchRequest:output"})
     */
    private $identifier;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"DispatchRequest:output:name", "DispatchRequest:input"})
     *
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Groups({"DispatchRequest:output"})
     *
     * @var \DateTimeInterface
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Groups({"DispatchRequest:output"})
     *
     * @var string
     */
    private $personIdentifier;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var string
     */
    private $senderFullName;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var string
     */
    private $senderOrganizationName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Groups({"DispatchRequest:output"})
     *
     * @var \DateTimeInterface
     */
    private $dateSubmitted;

    /**
     * @ORM\Column(type="string", length=2)
     *
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @Assert\Length(
     *     max=2,
     *     maxMessage="Only {{ limit }} letter country codes are allowed"
     * )
     *
     * @var string
     */
    private $senderAddressCountry;

    /**
     * @ORM\Column(type="string", length=20)
     *
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @Assert\Length(
     *     max=20,
     *     maxMessage="Only {{ limit }} letter postal codes are allowed"
     * )
     *
     * @var string
     */
    private $senderPostalCode;

    /**
     * @ORM\Column(type="string", length=120)
     *
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @Assert\Length(
     *     max=120,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var string
     */
    private $senderAddressLocality;

    /**
     * @ORM\Column(type="string", length=120)
     *
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @Assert\Length(
     *     max=120,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var string
     */
    private $senderStreetAddress;

    /**
     * @ORM\Column(type="string", length=10)
     *
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @Assert\Length(
     *     max=10,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var string
     */
    private $senderBuildingNumber;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @Assert\NotNull
     *
     * @var string
     */
    private $groupId;

    /**
     * @ORM\Column(type="string", length=25)
     *
     * @Groups({"DispatchRequest:output", "DispatchRequest:input"})
     *
     * @Assert\Length(
     *     max=25,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var ?string
     */
    private $referenceNumber;

    /**
     * @ORM\OneToMany(targetEntity="RequestRecipient", mappedBy="request")
     *
     * @ORM\OrderBy({"dateCreated" = "ASC"})
     *
     * @Groups({"DispatchRequest:output"})
     */
    private $recipients;

    /**
     * @ORM\OneToMany(targetEntity="RequestFile", mappedBy="request")
     *
     * @ORM\OrderBy({"dateCreated" = "ASC"})
     *
     * @Groups({"DispatchRequest:output:files"})
     */
    private $files;

    public function __construct()
    {
        $this->recipients = new ArrayCollection();
        $this->files = new ArrayCollection();
    }

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
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    public function getPersonIdentifier(): ?string
    {
        return $this->personIdentifier;
    }

    public function setPersonIdentifier(string $personIdentifier): void
    {
        $this->personIdentifier = $personIdentifier;
    }

    public function getSenderFullName(): ?string
    {
        return $this->senderFullName;
    }

    public function setSenderFullName(string $senderFullName): void
    {
        $this->senderFullName = $senderFullName;
    }

    public function getSenderOrganizationName(): ?string
    {
        return $this->senderOrganizationName;
    }

    public function setSenderOrganizationName(string $senderOrganizationName): void
    {
        $this->senderOrganizationName = $senderOrganizationName;
    }

    /**
     * @return ArrayCollection|RequestRecipient[]
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    public function getFiles()
    {
        return $this->files;
    }

    public function getDateSubmitted(): ?\DateTimeInterface
    {
        /** @var \DateTime $date */
        $date = $this->dateSubmitted;

        return $date === null ? null : $date->setTimezone(new \DateTimeZone('UTC'));
    }

    public function isSubmitted(): bool
    {
        return $this->dateSubmitted !== null;
    }

    public function setDateSubmitted(\DateTimeInterface $dateSubmitted): void
    {
        $this->dateSubmitted = $dateSubmitted;
    }

    public function getSenderAddressCountry(): string
    {
        return $this->senderAddressCountry;
    }

    public function setSenderAddressCountry(string $senderAddressCountry): void
    {
        $this->senderAddressCountry = $senderAddressCountry;
    }

    public function getSenderPostalCode(): string
    {
        return $this->senderPostalCode;
    }

    public function setSenderPostalCode(string $senderPostalCode): void
    {
        $this->senderPostalCode = $senderPostalCode;
    }

    public function getSenderAddressLocality(): string
    {
        return $this->senderAddressLocality;
    }

    public function setSenderAddressLocality(string $senderAddressLocality): void
    {
        $this->senderAddressLocality = $senderAddressLocality;
    }

    public function getSenderStreetAddress(): string
    {
        return $this->senderStreetAddress;
    }

    public function setSenderStreetAddress(string $senderStreetAddress): void
    {
        $this->senderStreetAddress = $senderStreetAddress;
    }

    public function getSenderBuildingNumber(): string
    {
        return $this->senderBuildingNumber;
    }

    public function setSenderBuildingNumber(string $senderBuildingNumber): void
    {
        $this->senderBuildingNumber = $senderBuildingNumber;
    }

    public function getName(): string
    {
        return $this->name ?? '';
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getGroupId(): string
    {
        return $this->groupId;
    }

    public function setGroupId(string $groupId): void
    {
        $this->groupId = $groupId;
    }

    public function setRequestRecipients(ArrayCollection $recipients)
    {
        $this->recipients = $recipients;
    }

    public function setRequestFiles(ArrayCollection $files)
    {
        $this->files = $files;
    }

    public function getReferenceNumber(): ?string
    {
        return $this->referenceNumber;
    }

    public function setReferenceNumber(string $referenceNumber): void
    {
        $this->referenceNumber = $referenceNumber;
    }
}
