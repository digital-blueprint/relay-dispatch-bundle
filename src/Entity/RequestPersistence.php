<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dispatch_requests")
 */
class RequestPersistence
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
    private $personIdentifier;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $senderGivenName;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $senderFamilyName;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $senderPostalAddress;

    /**
     * @OneToMany(targetEntity="RecipientPersistence", mappedBy="dispatchRequestIdentifier")
     */
    private $recipientPersistences;

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

    public function getPersonIdentifier(): string
    {
        return $this->personIdentifier;
    }

    public function setPersonIdentifier(string $personIdentifier): void
    {
        $this->personIdentifier = $personIdentifier;
    }

    public function getSenderGivenName(): string
    {
        return $this->senderGivenName;
    }

    public function setSenderGivenName(string $senderGivenName): void
    {
        $this->senderGivenName = $senderGivenName;
    }

    public function getSenderFamilyName(): string
    {
        return $this->senderFamilyName;
    }

    public function setSenderFamilyName(string $senderFamilyName): void
    {
        $this->senderFamilyName = $senderFamilyName;
    }

    public function getSenderPostalAddress(): string
    {
        return $this->senderPostalAddress;
    }

    public function setSenderPostalAddress(string $senderPostalAddress): void
    {
        $this->senderPostalAddress = $senderPostalAddress;
    }

    public static function fromRequest(Request $request): RequestPersistence
    {
        $requestPersistence = new RequestPersistence();
        $requestPersistence->setIdentifier($request->getIdentifier());
        $requestPersistence->setPersonIdentifier($request->getPersonIdentifier() === null ? '' : $request->getPersonIdentifier());
        $requestPersistence->setSenderGivenName($request->getSenderGivenName() === null ? '' : $request->getSenderGivenName());
        $requestPersistence->setSenderFamilyName($request->getSenderFamilyName() === null ? '' : $request->getSenderFamilyName());
        $requestPersistence->setSenderPostalAddress($request->getSenderPostalAddress() === null ? '' : $request->getSenderPostalAddress());

        if ($request->getDateCreated() !== null) {
            $requestPersistence->setDateCreated($request->getDateCreated());
        }

        return $requestPersistence;
    }

    /**
     * @return RequestRecipientPersistence[]
     */
    public function getRecipientPersistences()
    {
        return $this->recipientPersistences;
    }
}
