<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class NotificationAddress
{
    /**
     * @var WebserviceURL
     */
    protected $WebserviceURL = null;

    /**
     * @var InternetAddressType
     */
    protected $Email = null;

    /**
     * @var string
     */
    protected $Type = null;

    /**
     * @param WebserviceURL       $WebserviceURL
     * @param InternetAddressType $Email
     * @param string              $Type
     */
    public function __construct($WebserviceURL, $Email, $Type)
    {
        $this->WebserviceURL = $WebserviceURL;
        $this->Email = $Email;
        $this->Type = $Type;
    }

    /**
     * @return WebserviceURL
     */
    public function getWebserviceURL()
    {
        return $this->WebserviceURL;
    }

    /**
     * @param WebserviceURL $WebserviceURL
     *
     * @return NotificationAddress
     */
    public function setWebserviceURL($WebserviceURL)
    {
        $this->WebserviceURL = $WebserviceURL;

        return $this;
    }

    /**
     * @return InternetAddressType
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param InternetAddressType $Email
     *
     * @return NotificationAddress
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param string $Type
     *
     * @return NotificationAddress
     */
    public function setType($Type)
    {
        $this->Type = $Type;

        return $this;
    }
}
