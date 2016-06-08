<?php

namespace Webburza\Sylius\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Webburza\Sylius\ArticleBundle\Model\ArticleCategoryInterface;
use Webburza\Sylius\ArticleBundle\Model\ArticleImageInterface;
use Webburza\Sylius\ArticleBundle\Model\ArticleInterface;
use Webburza\Sylius\ArticleBundle\Validator\Constraints;

/**
 * Article
 *
 * @ORM\Table(name="webburza_sylius_article")
 * @ORM\Entity()
 * @Constraints\HasActiveTranslation()
 */
class Article implements ArticleInterface
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
     * @var boolean
     *
     * @ORM\Column(name="featured", type="boolean")
     */
    protected $featured;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    protected $publishedAt;

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
     * @var ArticleImageInterface
     * @ORM\OneToOne(targetEntity="Webburza\Sylius\ArticleBundle\Model\ArticleImageInterface", mappedBy="article", cascade={"persist", "remove"})
     */
    protected $image;

    /**
     * @var ArticleCategoryInterface
     * @ORM\ManyToOne(targetEntity="Webburza\Sylius\ArticleBundle\Model\ArticleCategoryInterface", inversedBy="articles")
     */
    protected $category;

    /**
     * Article constructor.
     */
    public function __construct()
    {
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
     * @return string
     */
    public function getLead()
    {
        return $this->translate()->getLead();
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->translate()->getContent();
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
     * @return ArticleInterface
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isFeatured()
    {
        return $this->featured;
    }

    /**
     * @param boolean $featured
     * @return ArticleInterface
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param \DateTime $publishedAt
     * @return ArticleInterface
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
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
     * @return ArticleInterface
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
     * @return ArticleInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return ArticleImageInterface
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param ArticleImageInterface $image
     * @return ArticleInterface
     */
    public function setImage(ArticleImageInterface $image)
    {
        $this->image = $image;
        $image->setArticle($this);

        return $this;
    }

    /**
     * Remove the image.
     *
     * @return ArticleInterface
     */
    public function clearImage()
    {
        $this->image = null;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->translate()->getMetaKeywords();
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->translate()->getMetaDescription();
    }

    /**
     * @return ArticleCategoryInterface
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param ArticleCategoryInterface $category
     * @return ArticleInterface
     */
    public function setCategory(ArticleCategoryInterface $category)
    {
        $this->category = $category;

        return $this;
    }
}
