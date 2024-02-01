<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class EMailDeliveryType extends DeliveryChannelSetType
{
    /**
     * @var ?bool
     */
    protected $RegMail;

    /**
     * @var ?string
     */
    protected $RegMailDepositUntil;

    /**
     * @var ?string
     */
    protected $MailBody;

    /**
     * @var ?string
     */
    protected $MIMEType;

    public function getRegMail(): ?bool
    {
        return $this->RegMail;
    }

    public function setRegMail(bool $RegMail): void
    {
        $this->RegMail = $RegMail;
    }

    public function getRegMailDepositUntil(): ?\DateTimeInterface
    {
        if ($this->RegMailDepositUntil === null) {
            return null;
        } else {
            return new \DateTimeImmutable($this->RegMailDepositUntil);
        }
    }

    public function setRegMailDepositUntil(\DateTimeInterface $RegMailDepositUntil): void
    {
        $this->RegMailDepositUntil = $RegMailDepositUntil->format(\DateTime::ATOM);
    }

    public function getMailBody(): ?string
    {
        return $this->MailBody;
    }

    public function setMailBody(string $MailBody): void
    {
        $this->MailBody = $MailBody;
    }

    public function getMIMEType(): ?string
    {
        return $this->MIMEType;
    }

    public function setMIMEType(string $MIMEType): void
    {
        $this->MIMEType = $MIMEType;
    }
}
