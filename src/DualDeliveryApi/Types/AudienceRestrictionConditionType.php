<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AudienceRestrictionConditionType extends ConditionAbstractType
{
    /**
     * @var AnyURI
     */
    protected $Audience = null;

    /**
     * @param AnyURI $Audience
     */
    public function __construct($Audience)
    {
        $this->Audience = $Audience;
    }

    public function getAudience(): AnyURI
    {
        return $this->Audience;
    }

    public function setAudience(AnyURI $Audience): self
    {
        $this->Audience = $Audience;

        return $this;
    }
}
