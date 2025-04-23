<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

class AudienceRestrictionConditionType extends ConditionAbstractType
{
    /**
     * @var string
     */
    protected $Audience;

    /**
     * @param string $Audience
     */
    public function __construct($Audience)
    {
        $this->Audience = $Audience;
    }

    public function getAudience(): string
    {
        return $this->Audience;
    }

    public function setAudience(string $Audience): self
    {
        $this->Audience = $Audience;

        return $this;
    }
}
