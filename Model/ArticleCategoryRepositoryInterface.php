<?php

namespace Webburza\Sylius\ArticleBundle\Model;

use Sylius\Component\Resource\Repository\RepositoryInterface;

interface ArticleCategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * Find a publicly visible article category by a slug, for the provided locale.
     *
     * @param $slug
     * @param $locale
     *
     * @return ArticleCategoryInterface|null
     */
    public function findPublicBySlug($slug, $locale);
}
