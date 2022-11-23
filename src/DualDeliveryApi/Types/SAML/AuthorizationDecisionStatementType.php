<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AnyURI;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DecisionType;

class AuthorizationDecisionStatementType extends SubjectStatementAbstractType
{
    /**
     * @var ActionType
     */
    protected $Action = null;

    /**
     * @var EvidenceType
     */
    protected $Evidence = null;

    /**
     * @var AnyURI
     */
    protected $Resource = null;

    /**
     * @var DecisionType
     */
    protected $Decision = null;

    /**
     * @param SubjectType  $Subject
     * @param ActionType   $Action
     * @param EvidenceType $Evidence
     * @param AnyURI       $Resource
     * @param DecisionType $Decision
     */
    public function __construct($Subject, $Action, $Evidence, $Resource, $Decision)
    {
        parent::__construct($Subject);
        $this->Action = $Action;
        $this->Evidence = $Evidence;
        $this->Resource = $Resource;
        $this->Decision = $Decision;
    }

    public function getAction(): ActionType
    {
        return $this->Action;
    }

    public function setAction(ActionType $Action): self
    {
        $this->Action = $Action;

        return $this;
    }

    public function getEvidence(): EvidenceType
    {
        return $this->Evidence;
    }

    public function setEvidence(EvidenceType $Evidence): self
    {
        $this->Evidence = $Evidence;

        return $this;
    }

    public function getResource(): AnyURI
    {
        return $this->Resource;
    }

    public function setResource(AnyURI $Resource): self
    {
        $this->Resource = $Resource;

        return $this;
    }

    public function getDecision(): DecisionType
    {
        return $this->Decision;
    }

    public function setDecision(DecisionType $Decision): self
    {
        $this->Decision = $Decision;

        return $this;
    }
}
