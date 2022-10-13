<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return AttributeType
     */
    public function getAttribute()
    {
        return $this->Attribute;
    }

    /**
     * @param AttributeType $Attribute
     *
     * @return AttributeStatementType
     */
    public function setAttribute($Attribute)
    {
        $this->Attribute = $Attribute;

        return $this;
    }
}
