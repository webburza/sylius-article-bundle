<?php

namespace Webburza\Sylius\ArticleBundle\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Webburza\Sylius\ArticleBundle\Model\ArticleCategoryInterface;
use Webburza\Sylius\ArticleBundle\Repository\ArticleCategoryRepositoryInterface;

class ArticleCategoryRepository extends EntityRepository implements ArticleCategoryRepositoryInterface
{
    /**
     * @param string $locale
     *
     * @return QueryBuilder
     */
    public function createListQueryBuilder($locale)
    {
        $queryBuilder = $this->createQueryBuilder('o');

        $queryBuilder
            ->addSelect('translation')
            ->leftJoin('o.translations', 'translation')
            ->andWhere('translation.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        return $queryBuilder;
    }

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

    /**
     * @param array $sorting
     *
     * @return array
     */
    public function findPublic(array $sorting = [])
    {
        $queryBuilder = $this->createQueryBuilder('ac');
        $queryBuilder->leftJoin('ac.translations', 'translation');
        $queryBuilder->andWhere('ac.published = true');

        $this->applySorting($queryBuilder, $sorting);

        return $queryBuilder->getQuery()->getResult();
    }
}
