<?php

namespace Webburza\Sylius\ArticleBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Webburza\Sylius\ArticleBundle\Model\ArticleCategoryInterface;
use Webburza\Sylius\ArticleBundle\Model\ArticleInterface;

interface ArticleRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $locale
     *
     * @return QueryBuilder
     */
    public function createListQueryBuilder($locale);

    /**
     * Get publicly visible articles
     *
     * @param $locale
     * @param ArticleCategoryInterface|null $category
     *
     * @return mixed|\Pagerfanta\Pagerfanta
     */
    public function getPublicPaginatorForLocale($locale, ArticleCategoryInterface $category = null);

    /**
     * Find an article by a slug, for the provided locale.
     *
     * @param $slug
     * @param $locale
     *
     * @return null|ArticleInterface
     */
    public function findPublicBySlug($slug, $locale);

    /**
     * Get related articles for an article.
     *
     * @param ArticleInterface $article
     * @param $locale
     * @param int $limit
     *
     * @return ArticleInterface[]
     */
    public function getRelatedArticles(ArticleInterface $article, $locale, $limit = 6);
}
