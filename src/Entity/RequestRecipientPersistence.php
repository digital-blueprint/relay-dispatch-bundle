<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dispatch_request_recipients")
 */
class RequestRecipientPersistence
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=50)
     */
    private $identifier;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @var string
     */
    private $dispatchRequestIdentifier;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @var string
     */
    private $recipientId;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $givenName;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $familyName;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $postalAddress;

    public function getIdentifier(): string
    {
        return (string) $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    public function getDispatchRequestIdentifier(): string
    {
        return $this->dispatchRequestIdentifier;
    }

    public function setDispatchRequestIdentifier(string $dispatchRequestIdentifier): void
    {
        $this->dispatchRequestIdentifier = $dispatchRequestIdentifier;
    }

    public function getRecipientId(): string
    {
        return $this->recipientId;
    }

    public function setRecipientId(string $recipientId): void
    {
        $this->recipientId = $recipientId;
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

    public function getPostalAddress(): ?string
    {
        return $this->postalAddress;
    }

    public function setPostalAddress(string $postalAddress): void
    {
        $this->postalAddress = $postalAddress;
    }

    public static function fromRequestRecipient(RequestRecipient $requestRecipient): RequestRecipientPersistence
    {
        $requestRecipientPersistence = new RequestRecipientPersistence();
        $requestRecipientPersistence->setIdentifier($requestRecipient->getIdentifier());
        $requestRecipientPersistence->setDispatchRequestIdentifier($requestRecipient->getDispatchRequestIdentifier() === null ? '' : $requestRecipient->getDispatchRequestIdentifier());
        $requestRecipientPersistence->setGivenName($requestRecipient->getGivenName() === null ? '' : $requestRecipient->getGivenName());
        $requestRecipientPersistence->setFamilyName($requestRecipient->getFamilyName() === null ? '' : $requestRecipient->getFamilyName());
        $requestRecipientPersistence->setPostalAddress($requestRecipient->getPostalAddress() === null ? '' : $requestRecipient->getPostalAddress());

        if ($requestRecipient->getDateCreated() !== null) {
            $requestRecipientPersistence->setDateCreated($requestRecipient->getDateCreated());
        }

        return $requestRecipientPersistence;
    }
}
