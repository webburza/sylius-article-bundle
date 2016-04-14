<?php

namespace Webburza\Sylius\ArticleBundle\Doctrine\ORM;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class ArticleRepository extends EntityRepository implements RepositoryInterface
{
    /**
     * Get publicly visible articles
     *
     * @param $locale
     *
     * @return mixed|\Pagerfanta\Pagerfanta
     */
    public function getPublicPaginatorForLocale($locale)
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->leftJoin('a.translations', 't');

        $queryBuilder
            ->andWhere('t.locale = :locale')
            ->andWhere('a.published = true')
            ->andWhere('t.active = true');

        $queryBuilder->setParameters([
            ':locale' => $locale
        ]);

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

        $queryBuilder
            ->andWhere('t.slug = :slug')
            ->andWhere('t.locale = :locale')
            ->andWhere('a.published = true')
            ->andWhere('t.active = true');

        $queryBuilder->setParameters([
            ':slug' => $slug,
            ':locale' => $locale
        ]);

        $article = $queryBuilder->getQuery()->getOneOrNullResult();

        return $article;
    }
}
