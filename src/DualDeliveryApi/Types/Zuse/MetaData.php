<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class MetaData
{
    /**
     * @var ?string
     */
    protected $Subject = null;

    /**
     * @var ?string
     */
    protected $AppDeliveryID = null;

    /**
     * @var ?string
     */
    protected $GZ = null;

    /**
     * @var ?string
     */
    protected $MZSDeliveryID = null;

    /**
     * @var string
     */
    protected $DeliveryQuality = null;

    /**
     * @var ?bool
     */
    protected $DeliveryConfirmation = null;

    /**
     * @var ?DocumentClass
     */
    protected $DocumentClass = null;

    /**
     * @var ?ReferencesType
     */
    protected $References = null;

    /**
     * @var ?string
     */
    protected $StartNotificationBefore = null;

    /**
     * @var ?string
     */
    protected $DeliverBefore = null;

    /**
     * @var ?PrintParameter
     */
    protected $PrintParameter = null;

    public function __construct(?string $Subject, string $AppDeliveryID, ?string $GZ, ?string $MZSDeliveryID, string $DeliveryQuality, ?bool $DeliveryConfirmation, ?DocumentClass $DocumentClass, ?ReferencesType $References, ?\DateTimeInterface $StartNotificationBefore, ?\DateTimeInterface $DeliverBefore, ?PrintParameter $PrintParameter)
    {
        $this->Subject = $Subject;
        $this->AppDeliveryID = $AppDeliveryID;
        $this->GZ = $GZ;
        $this->MZSDeliveryID = $MZSDeliveryID;
        $this->DeliveryQuality = $DeliveryQuality;
        $this->DeliveryConfirmation = $DeliveryConfirmation;
        $this->DocumentClass = $DocumentClass;
        $this->References = $References;
        $this->StartNotificationBefore = $StartNotificationBefore->format(\DateTime::ATOM);
        $this->DeliverBefore = $DeliverBefore->format(\DateTime::ATOM);
        $this->PrintParameter = $PrintParameter;
    }

    public function getSubject(): ?string
    {
        return $this->Subject;
    }

    public function setSubject(string $Subject): void
    {
        $this->Subject = $Subject;
    }

    public function getAppDeliveryID(): ?string
    {
        return $this->AppDeliveryID;
    }

    public function setAppDeliveryID(string $AppDeliveryID): void
    {
        $this->AppDeliveryID = $AppDeliveryID;
    }

    public function getGZ(): ?string
    {
        return $this->GZ;
    }

    public function setGZ(string $GZ): void
    {
        $this->GZ = $GZ;
    }

    public function getMZSDeliveryID(): ?string
    {
        return $this->MZSDeliveryID;
    }

    public function setMZSDeliveryID(string $MZSDeliveryID): void
    {
        $this->MZSDeliveryID = $MZSDeliveryID;
    }

    public function getDeliveryQuality(): string
    {
        return $this->DeliveryQuality;
    }

    public function setDeliveryQuality(string $DeliveryQuality): void
    {
        $this->DeliveryQuality = $DeliveryQuality;
    }

    public function getDeliveryConfirmation(): ?bool
    {
        return $this->DeliveryConfirmation;
    }

    public function setDeliveryConfirmation(bool $DeliveryConfirmation): void
    {
        $this->DeliveryConfirmation = $DeliveryConfirmation;
    }

    public function getDocumentClass(): ?DocumentClass
    {
        return $this->DocumentClass;
    }

    public function setDocumentClass(DocumentClass $DocumentClass): void
    {
        $this->DocumentClass = $DocumentClass;
    }

    public function getReferences(): ?ReferencesType
    {
        return $this->References;
    }

    public function setReferences(ReferencesType $References): void
    {
        $this->References = $References;
    }

    public function getStartNotificationBefore(): ?\DateTimeInterface
    {
        if ($this->StartNotificationBefore === null) {
            return null;
        } else {
            return new \DateTimeImmutable($this->StartNotificationBefore);
        }
    }

    public function setStartNotificationBefore(\DateTime $StartNotificationBefore): void
    {
        $this->StartNotificationBefore = $StartNotificationBefore->format(\DateTime::ATOM);
    }

    public function getDeliverBefore(): ?\DateTimeInterface
    {
        if ($this->DeliverBefore === null) {
            return null;
        } else {
            return new \DateTimeImmutable($this->DeliverBefore);
        }
    }

    public function setDeliverBefore(\DateTime $DeliverBefore): void
    {
        $this->DeliverBefore = $DeliverBefore->format(\DateTime::ATOM);
    }

    public function getPrintParameter(): ?PrintParameter
    {
        return $this->PrintParameter;
    }

    public function setPrintParameter(PrintParameter $PrintParameter): void
    {
        $this->PrintParameter = $PrintParameter;
    }
}
