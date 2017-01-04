<?php

namespace Webburza\Sylius\ArticleBundle\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Webburza\Sylius\ArticleBundle\Model\ArticleCategoryInterface;
use Webburza\Sylius\ArticleBundle\Model\ArticleInterface;
use Webburza\Sylius\ArticleBundle\Repository\ArticleRepositoryInterface;

class ArticleRepository extends EntityRepository implements ArticleRepositoryInterface
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
     * Get publicly visible articles
     *
     * @param $locale
     * @param ArticleCategoryInterface|null $category
     *
     * @return mixed|\Pagerfanta\Pagerfanta
     */
    public function getPublicPaginatorForLocale($locale, ArticleCategoryInterface $category = null)
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->leftJoin('a.translations', 't');
        $queryBuilder->leftJoin('a.category', 'c');

        $queryBuilder
            ->andWhere('t.locale = :locale')
            ->andWhere('a.published = true')
            ->andWhere('t.active = true')
            ->andWhere('c.id IS NULL OR c.published = true');

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
     * Get related articles for an article.
     *
     * @param ArticleInterface $article
     * @param $locale
     * @param int $limit
     *
     * @return ArticleInterface[]
     */
    public function getRelatedArticles(ArticleInterface $article, $locale, $limit = 6)
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->leftJoin('a.translations', 't');
        $queryBuilder->leftJoin('a.category', 'c');

        $queryBuilder
            ->andWhere('t.locale = :locale')
            ->andWhere('a.published = true')
            ->andWhere('t.active = true')
            ->andWhere('c.id IS NULL OR c.published = true')
            ->andWhere('a.id != :currentArticleId');

        $queryBuilder->setParameters([
            ':locale' => $locale,
            ':currentArticleId' => $article->getId()
        ]);

        if ($article->getCategory()) {
            $queryBuilder->andWhere('c.id = :categoryId');
            $queryBuilder->setParameter(':categoryId', $article->getCategory()->getId());
        }

        $queryBuilder->orderBy('a.publishedAt', 'desc');
        $queryBuilder->setMaxResults($limit);

        $articles = $queryBuilder->getQuery()->getResult();

        return $articles;
    }

    /**
     * Find an article by a slug, for the provided locale.
     *
     * @param $slug
     * @param $locale
     *
     * @return null|ArticleInterface
     */
    public function findPublicBySlug($slug, $locale)
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->innerJoin('a.translations', 't');
        $queryBuilder->leftJoin('a.category', 'c');

        $queryBuilder
            ->andWhere('t.slug = :slug')
            ->andWhere('t.locale = :locale')
            ->andWhere('t.active = true');

        $queryBuilder->andWhere('a.published = true');
        $queryBuilder->andWhere('c.id IS NULL OR c.published = true');

        $queryBuilder->setParameters([
            ':slug' => $slug,
            ':locale' => $locale
        ]);

        $article = $queryBuilder->getQuery()->getOneOrNullResult();

        return $article;
    }
}
