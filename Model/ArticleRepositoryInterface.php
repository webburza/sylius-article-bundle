<?php

namespace Webburza\Sylius\ArticleBundle\Model;

use Sylius\Component\Resource\Repository\RepositoryInterface;

interface ArticleRepositoryInterface extends RepositoryInterface
{
    /**
     * Get publicly visible articles
     *
     * @param $locale
     * @param ArticleCategoryInterface|null $category
     * @return mixed|\Pagerfanta\Pagerfanta
     */
    public function getPublicPaginatorForLocale($locale, ArticleCategoryInterface $category = null);

    /**
     * Find a publicly visible article by a slug, for the provided locale.
     *
     * @param $slug
     * @param $locale
     *
     * @return ArticleInterface|null
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
