<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Entity;

date_default_timezone_set('UTC');

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class PreAddressingRequest
{
    #[Groups(['DispatchPreAddressingRequest:output'])]
    private $identifier;

    /**
     * @var string
     */
    #[Groups(['DispatchPreAddressingRequest:output', 'DispatchPreAddressingRequest:input', 'DispatchRequest:output'])]
    #[Assert\Length(max: 255, maxMessage: 'Only {{ limit }} letters are allowed')]
    private $givenName;

    /**
     * @var string
     */
    #[Groups(['DispatchPreAddressingRequest:output', 'DispatchPreAddressingRequest:input', 'DispatchRequest:output'])]
    #[Assert\Length(max: 255, maxMessage: 'Only {{ limit }} letters are allowed')]
    private $familyName;

    /**
     * @var \DateTimeInterface
     */
    #[Groups(['DispatchPreAddressingRequest:output', 'DispatchPreAddressingRequest:input'])] // I could not find an Assert that doesn't cause an error to do proper checks
    #[Assert\NotBlank]
    private $birthDate;

    /**
     * @var string
     */
    #[Groups(['DispatchPreAddressingRequest:output'])]
    private $dualDeliveryID;

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

    public function getDualDeliveryID(): string
    {
        return $this->dualDeliveryID;
    }

    public function setDualDeliveryID(string $dualDeliveryID): void
    {
        $this->dualDeliveryID = $dualDeliveryID;
    }
}
