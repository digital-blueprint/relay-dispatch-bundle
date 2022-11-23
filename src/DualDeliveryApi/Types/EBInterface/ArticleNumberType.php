<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class ArticleNumberType
{
    /**
     * @var ArticleNumberTypeType
     */
    protected $ArticleNumberType = null;

    /**
     * @param ArticleNumberTypeType $ArticleNumberType
     */
    public function __construct($ArticleNumberType)
    {
        $this->ArticleNumberType = $ArticleNumberType;
    }

    public function getArticleNumberType(): ArticleNumberTypeType
    {
        return $this->ArticleNumberType;
    }

    public function setArticleNumberType(ArticleNumberTypeType $ArticleNumberType): self
    {
        $this->ArticleNumberType = $ArticleNumberType;

        return $this;
    }
}
