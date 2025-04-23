<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

class AuthorizationDecisionStatementType extends SubjectStatementAbstractType
{
    /**
     * @var ActionType
     */
    protected $Action;

    /**
     * @var EvidenceType
     */
    protected $Evidence;

    /**
     * @var string
     */
    protected $Resource;

    /**
     * @var DecisionType
     */
    protected $Decision;

    /**
     * @param SubjectType  $Subject
     * @param ActionType   $Action
     * @param EvidenceType $Evidence
     * @param string       $Resource
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

    public function getResource(): string
    {
        return $this->Resource;
    }

    public function setResource(string $Resource): self
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
