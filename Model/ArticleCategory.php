<?php

namespace Webburza\Sylius\ArticleBundle\Model;

use Gedmo\Timestampable\Traits\Timestampable;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

class ArticleCategory implements ArticleCategoryInterface
{
    use Timestampable;

    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var boolean
     */
    protected $published;

    /**
     * @var ArticleInterface[]
     */
    protected $articles;

    /**
     * ArticleCategory constructor.
     */
    public function __construct()
    {
        $this->initializeTranslationsCollection();

        $this->articles = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getTranslation()->getTitle();
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->getTranslation()->getSlug();
    }

    /**
     * @return boolean
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * @param boolean $published
     *
     * @return ArticleCategoryInterface
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * @return ArticleInterface[]
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param $articles
     *
     * @return ArticleCategoryInterface
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;

        return $this;
    }

    /**
     * @param ArticleInterface $article
     *
     * @return ArticleCategoryInterface
     */
    public function addArticle(ArticleInterface $article)
    {
        $this->articles->add($article);

        return $this;
    }

    /**
     * @return ArticleCategoryTranslationInterface
     */
    public function createTranslation()
    {
        return new ArticleCategoryTranslation();
    }
}
