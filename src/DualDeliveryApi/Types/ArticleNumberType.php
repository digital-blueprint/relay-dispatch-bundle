<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return ArticleNumberTypeType
     */
    public function getArticleNumberType()
    {
        return $this->ArticleNumberType;
    }

    /**
     * @param ArticleNumberTypeType $ArticleNumberType
     *
     * @return ArticleNumberType
     */
    public function setArticleNumberType($ArticleNumberType)
    {
        $this->ArticleNumberType = $ArticleNumberType;

        return $this;
    }
}
