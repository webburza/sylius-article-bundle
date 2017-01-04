<?php

namespace Webburza\Sylius\ArticleBundle\Repository;

use Doctrine\DBAL\Query\QueryBuilder;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Webburza\Sylius\ArticleBundle\Model\ArticleCategoryInterface;

interface ArticleCategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $locale
     *
     * @return QueryBuilder
     */
    public function createListQueryBuilder($locale);

    /**
     * Find a publicly visible article category by a slug, for the provided locale.
     *
     * @param $slug
     * @param $locale
     *
     * @return ArticleCategoryInterface|null
     */
    public function findPublicBySlug($slug, $locale);

    /**
     * @param array $sorting
     *
     * @return array
     */
    public function findPublic(array $sorting = []);
}
