<?php

namespace Webburza\Sylius\ArticleBundle\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

interface ArticleCategoryInterface extends ResourceInterface, TranslatableInterface
{
    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getSlug();

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @param \DateTime $createdAt
     * @return ArticleCategoryInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * @param \DateTime $updatedAt
     * @return ArticleCategoryInterface
     */
    public function setUpdatedAt($updatedAt);

    /**
     * @return boolean
     */
    public function isPublished();

    /**
     * @param boolean $published
     * @return ArticleCategoryInterface
     */
    public function setPublished($published);

    /**
     * @return ArticleInterface[]
     */
    public function getArticles();

    /**
     * @param $articles
     * @return ArticleCategoryInterface
     */
    public function setArticles($articles);

    /**
     * @param ArticleInterface $article
     * @return ArticleCategoryInterface
     */
    public function addArticle(ArticleInterface $article);
}
