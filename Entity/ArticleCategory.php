<?php

namespace Webburza\Sylius\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Webburza\Sylius\ArticleBundle\Model\ArticleCategoryInterface;
use Webburza\Sylius\ArticleBundle\Model\ArticleInterface;
use Webburza\Sylius\ArticleBundle\Validator\Constraints;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Article
 *
 * @ORM\Table(name="webburza_sylius_article_category")
 * @ORM\Entity()
 */
class ArticleCategory implements ArticleCategoryInterface
{
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean")
     */
    protected $published;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

    /**
     * @var ArticleInterface[]
     * @ORM\OneToMany(targetEntity="Webburza\Sylius\ArticleBundle\Model\ArticleInterface", mappedBy="category")
     */
    protected $articles;

    /**
     * ArticleCategory constructor.
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->initializeTranslationsCollection();
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
        return $this->translate()->getTitle();
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->translate()->getSlug();
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return ArticleCategoryInterface
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return ArticleCategoryInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
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
     * @return ArticleCategoryInterface
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;

        return $this;
    }

    /**
     * @param ArticleInterface $article
     * @return ArticleCategoryInterface
     */
    public function addArticle(ArticleInterface $article)
    {
        $this->articles->add($article);

        return $this;
    }
}
