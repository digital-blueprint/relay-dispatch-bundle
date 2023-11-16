<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use Dbp\Relay\CoreBundle\Exception\ApiError;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dispatch_request_recipients")
 */
class RequestRecipient
{
    /**
     * @ORM\Id
     *
     * @ORM\Column(type="string", length=50)
     *
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequest:output"})
     */
    private $identifier;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequest:output"})
     *
     * @var \DateTimeInterface
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity="Request", inversedBy="recipients")
     *
     * @ORM\JoinColumn(name="dispatch_request_identifier", referencedColumnName="identifier")
     *
     * @Groups({"DispatchRequestRecipient:output"})
     *
     * @var Request
     */
    private $request;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input"})
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
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input", "DispatchRequest:output"})
     *
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var string
     */
    private $givenName;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input", "DispatchRequest:output"})
     *
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var string
     */
    private $familyName;

    /**
     * @ORM\Column(type="string", length=2)
     *
     * @Groups({"DispatchRequestRecipient:output:addressCountry", "DispatchRequestRecipient:input"})
     *
     * @Assert\Length(
     *     max=2,
     *     maxMessage="Only {{ limit }} letter country codes are allowed"
     * )
     *
     * @var string
     */
    private $addressCountry;

    /**
     * @ORM\Column(type="string", length=20)
     *
     * @Groups({"DispatchRequestRecipient:output:postalCode", "DispatchRequestRecipient:input"})
     *
     * @Assert\Length(
     *     max=20,
     *     maxMessage="Only {{ limit }} letter postal codes are allowed"
     * )
     *
     * @var string
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=120)
     *
     * @Groups({"DispatchRequestRecipient:output:addressLocality", "DispatchRequestRecipient:input"})
     *
     * @Assert\Length(
     *     max=120,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var string
     */
    private $addressLocality;

    /**
     * @ORM\Column(type="string", length=120)
     *
     * @Groups({"DispatchRequestRecipient:output:streetAddress", "DispatchRequestRecipient:input"})
     *
     * @Assert\Length(
     *     max=120,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var string
     */
    private $streetAddress;

    /**
     * @ORM\Column(type="string", length=10)
     *
     * @Groups({"DispatchRequestRecipient:output:buildingNumber", "DispatchRequestRecipient:input"})
     *
     * @Assert\Length(
     *     max=10,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var string
     */
    private $buildingNumber;

    /**
     * @ORM\Column(type="date")
     *
     * @Groups({"DispatchRequestRecipient:output:birthDate", "DispatchRequestRecipient:input"})
     * I could not find an Assert that doesn't cause an error to do proper checks
     *
     * @var \DateTimeInterface
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Groups({"DispatchRequestRecipient:output"})
     *
     * @var string
     */
    private $dualDeliveryID;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @Groups({"DispatchRequestRecipient:output"})
     *
     * @var string
     */
    private $appDeliveryID;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Groups({"DispatchRequestRecipient:output"})
     *
     * @var \DateTimeInterface|null
     */
    private $deliveryEndDate;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequestRecipient:input", "DispatchRequest:output"})
     *
     * @Assert\Length(
     *     max=100,
     *     maxMessage="Only {{ limit }} letters are allowed"
     * )
     *
     * @var string
     */
    private $personIdentifier;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequest:output"})
     *
     * @var bool
     */
    private $postalDeliverable;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequest:output"})
     *
     * @var bool
     */
    private $electronicallyDeliverable;

    /**
     * @Groups({"DispatchRequestRecipient:output", "DispatchRequest:output"})
     *
     * @var ?DeliveryStatusChange
     */
    private $lastStatusChange;

    /**
     * @ORM\OneToMany(targetEntity="DeliveryStatusChange", mappedBy="requestRecipient")
     *
     * @ORM\OrderBy({"orderId" = "DESC"})
     *
     * @Groups({"DispatchRequestRecipient:output"})
     */
    private $statusChanges;

    public function __construct()
    {
        $this->statusChanges = new ArrayCollection();
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

    public function getRecipientId(): string
    {
        return $this->recipientId;
    }

    public function setRecipientId(string $recipientId): void
    {
        $this->recipientId = $recipientId;
    }

    public function getFullName(): string
    {
        return $this->givenName.' '.$this->familyName;
    }

    public function getFullAddress(): string
    {
        return $this->streetAddress.' '.$this->buildingNumber.', '.$this->postalCode.
            ' '.$this->addressLocality.', '.$this->addressCountry;
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

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function getAddressCountry(): string
    {
        return $this->addressCountry;
    }

    public function setAddressCountry(string $addressCountry): void
    {
        $this->addressCountry = $addressCountry;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getAddressLocality(): string
    {
        return $this->addressLocality;
    }

    public function setAddressLocality(string $addressLocality): void
    {
        $this->addressLocality = $addressLocality;
    }

    public function getStreetAddress(): string
    {
        return $this->streetAddress;
    }

    public function setStreetAddress(string $streetAddress): void
    {
        $this->streetAddress = $streetAddress;
    }

    public function getBuildingNumber(): ?string
    {
        return $this->buildingNumber;
    }

    public function setBuildingNumber(string $buildingNumber): void
    {
        $this->buildingNumber = $buildingNumber;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function getDualDeliveryID(): string
    {
        return $this->dualDeliveryID;
    }

    public function setDualDeliveryID(string $dualDeliveryID): void
    {
        $this->dualDeliveryID = $dualDeliveryID;
    }

    public function getStatusChanges()
    {
        return $this->statusChanges;
    }

    public function getDeliveryEndDate(): ?\DateTimeInterface
    {
        return $this->deliveryEndDate;
    }

    public function setDeliveryEndDate(\DateTimeInterface $deliveryEndDate): void
    {
        $this->deliveryEndDate = $deliveryEndDate;
    }

    public function getAppDeliveryID(): string
    {
        return $this->appDeliveryID === null ?
            $this->request->getIdentifier().'-'.$this->identifier :
            $this->appDeliveryID;
    }

    public function setAppDeliveryID(string $appDeliveryID): void
    {
        $this->appDeliveryID = $appDeliveryID;
    }

    public function getPersonIdentifier(): ?string
    {
        return $this->personIdentifier;
    }

    public function setPersonIdentifier(string $personIdentifier): void
    {
        $this->personIdentifier = $personIdentifier;
    }

    public function isPostalDeliverable(): bool
    {
        // Can be null if not set
        return $this->postalDeliverable ?? false;
    }

    public function setPostalDeliverable(bool $postalDeliverable): void
    {
        $this->postalDeliverable = $postalDeliverable;
    }

    public function isElectronicallyDeliverable(): bool
    {
        // Can be null if not set
        return $this->electronicallyDeliverable ?? false;
    }

    public function setElectronicallyDeliverable(bool $electronicallyDeliverable): void
    {
        $this->electronicallyDeliverable = $electronicallyDeliverable;
    }

    public function canDoPreAddressingRequest(): bool
    {
        return $this->getGivenName() !== '' && $this->getFamilyName() !== '' && $this->getBirthDate();
    }

    public function hasValidAddress(): bool
    {
        // We don't check the building number, because it's not always available
        return $this->getStreetAddress() !== ''
            && $this->getPostalCode() !== ''
            && $this->getAddressLocality() !== ''
            && $this->getAddressCountry() !== '';
    }

    public function postValidityCheck(): void
    {
        // If there is a person identifier, then there must not be any other personal data set
        if ($this->personIdentifier
            && (
                $this->givenName
                || $this->familyName
                || $this->streetAddress
                || $this->buildingNumber
                || $this->postalCode
                || $this->addressLocality
                || $this->addressCountry
                || $this->birthDate
            )
        ) {
            throw ApiError::withDetails(Response::HTTP_BAD_REQUEST, 'A request recipient can\'t contain a personIdentifier and personal data together!', 'dispatch:request-recipient-person-identifier-and-person-data-set');
        }
    }

    public function getLastStatusChange(): ?DeliveryStatusChange
    {
        return $this->lastStatusChange;
    }

    public function setLastStatusChange(?DeliveryStatusChange $lastStatusChange): void
    {
        $this->lastStatusChange = $lastStatusChange;
    }
}
