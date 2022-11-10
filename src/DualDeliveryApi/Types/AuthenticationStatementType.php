<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AuthenticationStatementType extends SubjectStatementAbstractType
{
    /**
     * @var SubjectLocalityType
     */
    protected $SubjectLocality = null;

    /**
     * @var AuthorityBindingType
     */
    protected $AuthorityBinding = null;

    /**
     * @var AnyURI
     */
    protected $AuthenticationMethod = null;

    /**
     * @var \DateTime
     */
    protected $AuthenticationInstant = null;

    /**
     * @param SubjectType          $Subject
     * @param SubjectLocalityType  $SubjectLocality
     * @param AuthorityBindingType $AuthorityBinding
     * @param AnyURI               $AuthenticationMethod
     */
    public function __construct($Subject, $SubjectLocality, $AuthorityBinding, $AuthenticationMethod, \DateTime $AuthenticationInstant)
    {
        parent::__construct($Subject);
        $this->SubjectLocality = $SubjectLocality;
        $this->AuthorityBinding = $AuthorityBinding;
        $this->AuthenticationMethod = $AuthenticationMethod;
        $this->AuthenticationInstant = $AuthenticationInstant->format(\DateTime::ATOM);
    }

    public function getSubjectLocality(): SubjectLocalityType
    {
        return $this->SubjectLocality;
    }

    public function setSubjectLocality(SubjectLocalityType $SubjectLocality): self
    {
        $this->SubjectLocality = $SubjectLocality;

        return $this;
    }

    public function getAuthorityBinding(): AuthorityBindingType
    {
        return $this->AuthorityBinding;
    }

    public function setAuthorityBinding(AuthorityBindingType $AuthorityBinding): self
    {
        $this->AuthorityBinding = $AuthorityBinding;

        return $this;
    }

    public function getAuthenticationMethod(): AnyURI
    {
        return $this->AuthenticationMethod;
    }

    public function setAuthenticationMethod(AnyURI $AuthenticationMethod): self
    {
        $this->AuthenticationMethod = $AuthenticationMethod;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAuthenticationInstant()
    {
        if ($this->AuthenticationInstant === null) {
            return null;
        } else {
            try {
                return new \DateTime($this->AuthenticationInstant);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    public function setAuthenticationInstant(\DateTime $AuthenticationInstant): self
    {
        $this->AuthenticationInstant = $AuthenticationInstant->format(\DateTime::ATOM);

        return $this;
    }
}
