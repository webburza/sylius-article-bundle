<?php

namespace Webburza\Sylius\ArticleBundle\Doctrine\ORM;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class ArticleCategoryRepository extends EntityRepository implements RepositoryInterface
{
    /**
     * Find a publicly visible article category by a slug, for the provided locale.
     *
     * @param $slug
     * @param $locale
     *
     * @return array
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
