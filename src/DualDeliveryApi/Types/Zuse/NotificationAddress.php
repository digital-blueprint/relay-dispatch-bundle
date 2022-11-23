<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

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

    public function __construct(WebserviceURL $WebserviceURL, InternetAddressType $Email, string $Type)
    {
        $this->WebserviceURL = $WebserviceURL;
        $this->Email = $Email;
        $this->Type = $Type;
    }

    public function getWebserviceURL(): WebserviceURL
    {
        return $this->WebserviceURL;
    }

    public function setWebserviceURL(WebserviceURL $WebserviceURL): void
    {
        $this->WebserviceURL = $WebserviceURL;
    }

    public function getEmail(): InternetAddressType
    {
        return $this->Email;
    }

    public function setEmail(InternetAddressType $Email): void
    {
        $this->Email = $Email;
    }

    public function getType(): string
    {
        return $this->Type;
    }

    public function setType(string $Type): void
    {
        $this->Type = $Type;
    }
}
