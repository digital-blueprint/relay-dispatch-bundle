<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class SubjectType
{
    /**
     * @var NameIdentifierType
     */
    protected $NameIdentifier = null;

    /**
     * @var SubjectConfirmationType
     */
    protected $SubjectConfirmation = null;

    /**
     * @param NameIdentifierType      $NameIdentifier
     * @param SubjectConfirmationType $SubjectConfirmation
     */
    public function __construct($NameIdentifier, $SubjectConfirmation)
    {
        $this->NameIdentifier = $NameIdentifier;
        $this->SubjectConfirmation = $SubjectConfirmation;
    }

    public function getNameIdentifier(): NameIdentifierType
    {
        return $this->NameIdentifier;
    }

    public function setNameIdentifier(NameIdentifierType $NameIdentifier): self
    {
        $this->NameIdentifier = $NameIdentifier;

        return $this;
    }

    public function getSubjectConfirmation(): SubjectConfirmationType
    {
        return $this->SubjectConfirmation;
    }

    public function setSubjectConfirmation(SubjectConfirmationType $SubjectConfirmation): self
    {
        $this->SubjectConfirmation = $SubjectConfirmation;

        return $this;
    }
}
