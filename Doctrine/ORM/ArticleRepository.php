<?php

namespace Webburza\Sylius\ArticleBundle\Doctrine\ORM;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Webburza\Sylius\ArticleBundle\Entity\ArticleCategory;

class ArticleRepository extends EntityRepository implements RepositoryInterface
{
    /**
     * Get publicly visible articles
     *
     * @param $locale
     * @param ArticleCategory|null $category
     * @return mixed|\Pagerfanta\Pagerfanta
     */
    public function getPublicPaginatorForLocale($locale, ArticleCategory $category = null)
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->leftJoin('a.translations', 't');
        $queryBuilder->leftJoin('a.category', 'c');

        $queryBuilder
            ->andWhere('t.locale = :locale')
            ->andWhere('a.published = true')
            ->andWhere('t.active = true')
            ->andWhere('c IS NULL OR c.published = true');

        $queryBuilder->setParameters([
            ':locale' => $locale
        ]);

        if ($category) {
            $queryBuilder->andWhere('c.id = :categoryId');
            $queryBuilder->setParameter(':categoryId', $category->getId());
        }

        $queryBuilder->orderBy('a.publishedAt', 'desc');

        $paginator = $this->getPaginator($queryBuilder);

        return $paginator;
    }

    /**
     * Find a publicly visible article by a slug, for the provided locale.
     *
     * @param $slug
     * @param $locale
     *
     * @return array
     */
    public function findPublicBySlug($slug, $locale)
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->leftJoin('a.translations', 't');
        $queryBuilder->leftJoin('a.category', 'c');

        $queryBuilder
            ->andWhere('t.slug = :slug')
            ->andWhere('t.locale = :locale')
            ->andWhere('a.published = true')
            ->andWhere('t.active = true')
            ->andWhere('c IS NULL OR c.published = true');

        $queryBuilder->setParameters([
            ':slug' => $slug,
            ':locale' => $locale
        ]);

        $article = $queryBuilder->getQuery()->getOneOrNullResult();

        return $article;
    }
}
