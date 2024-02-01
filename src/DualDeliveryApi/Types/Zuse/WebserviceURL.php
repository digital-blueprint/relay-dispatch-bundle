<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class WebserviceURL
{
    /**
     * @var string
     */
    protected $_;

    /**
     * @var string
     */
    protected $AlternativeEmail;

    public function __construct(string $_, string $AlternativeEmail)
    {
        $this->_ = $_;
        $this->AlternativeEmail = $AlternativeEmail;
    }

    public function get_(): string
    {
        return $this->_;
    }

    public function set_(string $_): void
    {
        $this->_ = $_;
    }

    public function getAlternativeEmail(): string
    {
        return $this->AlternativeEmail;
    }

    public function setAlternativeEmail(string $AlternativeEmail): void
    {
        $this->AlternativeEmail = $AlternativeEmail;
    }
}
