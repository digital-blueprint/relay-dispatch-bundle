<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'dispatch_requests')]
#[ORM\Entity]
class Request
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['DispatchRequest:output'])]
    private ?string $identifier = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['DispatchRequest:read_content', 'DispatchRequest:input'])]
    #[Assert\Length(max: 255, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $name = null;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['DispatchRequest:output'])]
    private ?\DateTimeInterface $dateCreated = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['DispatchRequest:output'])]
    private ?string $personIdentifier = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 255, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $senderFullName = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 255, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $senderOrganizationName = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    #[Groups(['DispatchRequest:output'])]
    private ?\DateTimeInterface $dateSubmitted = null;

    #[ORM\Column(type: 'string', length: 2, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 2, maxMessage: 'Only {{ limit }} letter country codes are allowed')]
    private ?string $senderAddressCountry = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 20, maxMessage: 'Only {{ limit }} letter postal codes are allowed')]
    private ?string $senderPostalCode = null;

    #[ORM\Column(type: 'string', length: 120, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 120, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $senderAddressLocality = null;

    #[ORM\Column(type: 'string', length: 120, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 120, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $senderStreetAddress = null;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 10, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $senderBuildingNumber = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 255, maxMessage: 'Only {{ limit }} letters are allowed')]
    #[Assert\NotNull]
    private ?string $groupId = null;

    #[ORM\Column(type: 'string', length: 25, nullable: true)]
    #[Groups(['DispatchRequest:output', 'DispatchRequest:input'])]
    #[Assert\Length(max: 25, maxMessage: 'Only {{ limit }} letters are allowed')]
    private ?string $referenceNumber = null;

    #[ORM\OneToMany(targetEntity: RequestRecipient::class, mappedBy: 'request')]
    #[ORM\OrderBy(['dateCreated' => 'ASC'])]
    #[Groups(['DispatchRequest:output'])]
    private Collection $recipients;

    #[ORM\OneToMany(targetEntity: RequestFile::class, mappedBy: 'request')]
    #[ORM\OrderBy(['dateCreated' => 'ASC'])]
    #[Groups(['DispatchRequest:read_content'])]
    private Collection $files;

    public function __construct()
    {
        $this->recipients = new ArrayCollection();
        $this->files = new ArrayCollection();
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): void
    {
        $this->dateCreated = \DateTimeImmutable::createFromInterface($dateCreated);
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

    public function setSenderFullName(?string $senderFullName): void
    {
        $this->senderFullName = $senderFullName;
    }

    public function getSenderOrganizationName(): ?string
    {
        return $this->senderOrganizationName;
    }

    public function setSenderOrganizationName(?string $senderOrganizationName): void
    {
        $this->senderOrganizationName = $senderOrganizationName;
    }

    public function getRecipients(): Collection
    {
        return $this->recipients;
    }

    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function getDateSubmitted(): ?\DateTimeInterface
    {
        return $this->dateSubmitted;
    }

    public function isSubmitted(): bool
    {
        return $this->dateSubmitted !== null;
    }

    public function setDateSubmitted(?\DateTimeInterface $dateSubmitted): void
    {
        $this->dateSubmitted = \DateTimeImmutable::createFromInterface($dateSubmitted);
    }

    public function getSenderAddressCountry(): ?string
    {
        return $this->senderAddressCountry;
    }

    public function setSenderAddressCountry(?string $senderAddressCountry): void
    {
        $this->senderAddressCountry = $senderAddressCountry;
    }

    public function getSenderPostalCode(): ?string
    {
        return $this->senderPostalCode;
    }

    public function setSenderPostalCode(?string $senderPostalCode): void
    {
        $this->senderPostalCode = $senderPostalCode;
    }

    public function getSenderAddressLocality(): ?string
    {
        return $this->senderAddressLocality;
    }

    public function setSenderAddressLocality(?string $senderAddressLocality): void
    {
        $this->senderAddressLocality = $senderAddressLocality;
    }

    public function getSenderStreetAddress(): ?string
    {
        return $this->senderStreetAddress;
    }

    public function setSenderStreetAddress(?string $senderStreetAddress): void
    {
        $this->senderStreetAddress = $senderStreetAddress;
    }

    public function getSenderBuildingNumber(): ?string
    {
        return $this->senderBuildingNumber;
    }

    public function setSenderBuildingNumber(?string $senderBuildingNumber): void
    {
        $this->senderBuildingNumber = $senderBuildingNumber;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getGroupId(): ?string
    {
        return $this->groupId;
    }

    public function setGroupId(?string $groupId): void
    {
        $this->groupId = $groupId;
    }

    public function setRequestRecipients(Collection $recipients): void
    {
        $this->recipients = $recipients;
    }

    public function setRequestFiles(Collection $files): void
    {
        $this->files = $files;
    }

    public function getReferenceNumber(): ?string
    {
        return $this->referenceNumber;
    }

    public function setReferenceNumber(?string $referenceNumber): void
    {
        $this->referenceNumber = $referenceNumber;
    }
}
