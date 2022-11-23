<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class EMailDeliveryType extends DeliveryChannelSetType
{
    /**
     * @var ?bool
     */
    protected $RegMail = null;

    /**
     * @var ?string
     */
    protected $RegMailDepositUntil = null;

    /**
     * @var ?string
     */
    protected $MailBody = null;

    /**
     * @var ?string
     */
    protected $MIMEType = null;

    public function __construct()
    {
    }

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
