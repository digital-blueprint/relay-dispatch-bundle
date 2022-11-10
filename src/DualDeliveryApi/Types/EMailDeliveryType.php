<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class EMailDeliveryType extends DeliveryChannelSetType
{
    /**
     * @var bool
     */
    protected $RegMail = null;

    /**
     * @var \DateTime
     */
    protected $RegMailDepositUntil = null;

    /**
     * @var base64Binary
     */
    protected $MailBody = null;

    /**
     * @var string
     */
    protected $MIMEType = null;

    public function __construct()
    {
    }

    public function getRegMail(): bool
    {
        return $this->RegMail;
    }

    public function setRegMail(bool $RegMail): self
    {
        $this->RegMail = $RegMail;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRegMailDepositUntil()
    {
        if ($this->RegMailDepositUntil === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->RegMailDepositUntil);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    /**
     * @param \DateTime $RegMailDepositUntil
     */
    public function setRegMailDepositUntil(\DateTime $RegMailDepositUntil = null): self
    {
        if ($RegMailDepositUntil === null) {
            $this->RegMailDepositUntil = null;
        } else {
            $this->RegMailDepositUntil = $RegMailDepositUntil->format(\DateTime::ATOM);
        }

        return $this;
    }

    /**
     * @return base64Binary
     */
    public function getMailBody()
    {
        return $this->MailBody;
    }

    /**
     * @param base64Binary $MailBody
     */
    public function setMailBody($MailBody): self
    {
        $this->MailBody = $MailBody;

        return $this;
    }

    public function getMIMEType(): string
    {
        return $this->MIMEType;
    }

    public function setMIMEType(string $MIMEType): self
    {
        $this->MIMEType = $MIMEType;

        return $this;
    }
}
