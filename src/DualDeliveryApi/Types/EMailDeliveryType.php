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

    /**
     * @return bool
     */
    public function getRegMail()
    {
        return $this->RegMail;
    }

    /**
     * @param bool $RegMail
     *
     * @return EMailDeliveryType
     */
    public function setRegMail($RegMail)
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
     *
     * @return EMailDeliveryType
     */
    public function setRegMailDepositUntil(\DateTime $RegMailDepositUntil = null)
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
     *
     * @return EMailDeliveryType
     */
    public function setMailBody($MailBody)
    {
        $this->MailBody = $MailBody;

        return $this;
    }

    /**
     * @return string
     */
    public function getMIMEType()
    {
        return $this->MIMEType;
    }

    /**
     * @param string $MIMEType
     *
     * @return EMailDeliveryType
     */
    public function setMIMEType($MIMEType)
    {
        $this->MIMEType = $MIMEType;

        return $this;
    }
}
