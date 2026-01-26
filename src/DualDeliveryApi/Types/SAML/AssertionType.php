<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\IDType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\stringType;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig\SignatureType;

class AssertionType
{
    /**
     * @var ConditionsType
     */
    protected $Conditions;

    /**
     * @var AdviceType
     */
    protected $Advice;

    /**
     * @var StatementAbstractType
     */
    protected $Statement;

    /**
     * @var SubjectStatementAbstractType
     */
    protected $SubjectStatement;

    /**
     * @var AuthenticationStatementType
     */
    protected $AuthenticationStatement;

    /**
     * @var AuthorizationDecisionStatementType
     */
    protected $AuthorizationDecisionStatement;

    /**
     * @var AttributeStatementType
     */
    protected $AttributeStatement;

    /**
     * @var SignatureType
     */
    protected $Signature;

    /**
     * @var int
     */
    protected $MajorVersion;

    /**
     * @var int
     */
    protected $MinorVersion;

    /**
     * @var stringType
     */
    protected $AssertionID;

    /**
     * @var string
     */
    protected $Issuer;

    /**
     * @var \DateTime
     */
    protected $IssueInstant;

    /**
     * @param ConditionsType                     $Conditions
     * @param AdviceType                         $Advice
     * @param StatementAbstractType              $Statement
     * @param SubjectStatementAbstractType       $SubjectStatement
     * @param AuthenticationStatementType        $AuthenticationStatement
     * @param AuthorizationDecisionStatementType $AuthorizationDecisionStatement
     * @param AttributeStatementType             $AttributeStatement
     * @param SignatureType                      $Signature
     * @param int                                $MajorVersion
     * @param int                                $MinorVersion
     * @param IDType                             $AssertionID
     * @param string                             $Issuer
     */
    public function __construct($Conditions, $Advice, $Statement, $SubjectStatement, $AuthenticationStatement, $AuthorizationDecisionStatement, $AttributeStatement, $Signature, $MajorVersion, $MinorVersion, $AssertionID, $Issuer, \DateTime $IssueInstant)
    {
        $this->Conditions = $Conditions;
        $this->Advice = $Advice;
        $this->Statement = $Statement;
        $this->SubjectStatement = $SubjectStatement;
        $this->AuthenticationStatement = $AuthenticationStatement;
        $this->AuthorizationDecisionStatement = $AuthorizationDecisionStatement;
        $this->AttributeStatement = $AttributeStatement;
        $this->Signature = $Signature;
        $this->MajorVersion = $MajorVersion;
        $this->MinorVersion = $MinorVersion;
        $this->AssertionID = $AssertionID;
        $this->Issuer = $Issuer;
        $this->IssueInstant = $IssueInstant->format(\DateTime::ATOM);
    }

    public function getConditions(): ConditionsType
    {
        return $this->Conditions;
    }

    public function setConditions(ConditionsType $Conditions): self
    {
        $this->Conditions = $Conditions;

        return $this;
    }

    public function getAdvice(): AdviceType
    {
        return $this->Advice;
    }

    public function setAdvice(AdviceType $Advice): self
    {
        $this->Advice = $Advice;

        return $this;
    }

    public function getStatement(): StatementAbstractType
    {
        return $this->Statement;
    }

    public function setStatement(StatementAbstractType $Statement): self
    {
        $this->Statement = $Statement;

        return $this;
    }

    public function getSubjectStatement(): SubjectStatementAbstractType
    {
        return $this->SubjectStatement;
    }

    public function setSubjectStatement(SubjectStatementAbstractType $SubjectStatement): self
    {
        $this->SubjectStatement = $SubjectStatement;

        return $this;
    }

    public function getAuthenticationStatement(): AuthenticationStatementType
    {
        return $this->AuthenticationStatement;
    }

    public function setAuthenticationStatement(AuthenticationStatementType $AuthenticationStatement): self
    {
        $this->AuthenticationStatement = $AuthenticationStatement;

        return $this;
    }

    public function getAuthorizationDecisionStatement(): AuthorizationDecisionStatementType
    {
        return $this->AuthorizationDecisionStatement;
    }

    public function setAuthorizationDecisionStatement(AuthorizationDecisionStatementType $AuthorizationDecisionStatement): self
    {
        $this->AuthorizationDecisionStatement = $AuthorizationDecisionStatement;

        return $this;
    }

    public function getAttributeStatement(): AttributeStatementType
    {
        return $this->AttributeStatement;
    }

    public function setAttributeStatement(AttributeStatementType $AttributeStatement): self
    {
        $this->AttributeStatement = $AttributeStatement;

        return $this;
    }

    public function getSignature(): SignatureType
    {
        return $this->Signature;
    }

    public function setSignature(SignatureType $Signature): self
    {
        $this->Signature = $Signature;

        return $this;
    }

    public function getMajorVersion(): int
    {
        return $this->MajorVersion;
    }

    public function setMajorVersion(int $MajorVersion): self
    {
        $this->MajorVersion = $MajorVersion;

        return $this;
    }

    public function getMinorVersion(): int
    {
        return $this->MinorVersion;
    }

    public function setMinorVersion(int $MinorVersion): self
    {
        $this->MinorVersion = $MinorVersion;

        return $this;
    }

    /**
     * @return stringType
     */
    public function getAssertionID()
    {
        return $this->AssertionID;
    }

    /**
     * @param IDType $AssertionID
     */
    public function setAssertionID($AssertionID): self
    {
        $this->AssertionID = $AssertionID;

        return $this;
    }

    public function getIssuer(): string
    {
        return $this->Issuer;
    }

    public function setIssuer(string $Issuer): self
    {
        $this->Issuer = $Issuer;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getIssueInstant()
    {
        if ($this->IssueInstant === null) {
            return null;
        }
        try {
            return new \DateTime($this->IssueInstant);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function setIssueInstant(\DateTime $IssueInstant): self
    {
        $this->IssueInstant = $IssueInstant->format(\DateTime::ATOM);

        return $this;
    }
}
