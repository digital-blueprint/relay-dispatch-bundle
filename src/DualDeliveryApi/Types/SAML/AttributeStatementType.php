<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

class AttributeStatementType extends SubjectStatementAbstractType
{
    /**
     * @var AttributeType
     */
    protected $Attribute = null;

    /**
     * @param SubjectType   $Subject
     * @param AttributeType $Attribute
     */
    public function __construct($Subject, $Attribute)
    {
        parent::__construct($Subject);
        $this->Attribute = $Attribute;
    }

    public function getAttribute(): AttributeType
    {
        return $this->Attribute;
    }

    public function setAttribute(AttributeType $Attribute): self
    {
        $this->Attribute = $Attribute;

        return $this;
    }
}
