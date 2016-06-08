<?php

namespace Webburza\Sylius\ArticleBundle\Doctrine\ORM;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Webburza\Sylius\ArticleBundle\Model\ArticleCategoryInterface;
use Webburza\Sylius\ArticleBundle\Model\ArticleCategoryRepositoryInterface;

class ArticleCategoryRepository extends EntityRepository implements ArticleCategoryRepositoryInterface
{
    /**
     * Find a publicly visible article category by a slug, for the provided locale.
     *
     * @param $slug
     * @param $locale
     *
     * @return ArticleCategoryInterface|null
     */
    public function findPublicBySlug($slug, $locale)
    {
        $queryBuilder = $this->createQueryBuilder('ac');
        $queryBuilder->leftJoin('ac.translations', 't');

        $queryBuilder
            ->andWhere('t.slug = :slug')
            ->andWhere('t.locale = :locale')
            ->andWhere('ac.published = true');

        $queryBuilder->setParameters([
            ':slug' => $slug,
            ':locale' => $locale
        ]);

        $category = $queryBuilder->getQuery()->getOneOrNullResult();

        return $category;
    }
}
