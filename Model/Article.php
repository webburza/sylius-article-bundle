<?php

namespace Webburza\Sylius\ArticleBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Timestampable\Traits\Timestampable;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Webburza\Sylius\ArticleBundle\Validator\Constraints;

/**
 * @Constraints\HasActiveTranslation()
 */
class Article implements ArticleInterface
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
    protected $published = false;

    /**
     * @var boolean
     */
    protected $featured = false;

    /**
     * @var \DateTime
     */
    protected $publishedAt = null;

    /**
     * @var ArticleImageInterface
     */
    protected $image;

    /**
     * @var ArticleCategoryInterface
     */
    protected $category;

    /**
     * @var ProductInterface[]
     */
    protected $products;

    /**
     * Article constructor.
     */
    public function __construct()
    {
        $this->initializeTranslationsCollection();
        $this->products = new ArrayCollection();
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
     * @return string
     */
    public function getLead()
    {
        return $this->getTranslation()->getLead();
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getTranslation()->getContent();
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
     *
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
     *
     * @return ArticleInterface
     */
    public function setPublishedAt(\DateTime $publishedAt = null)
    {
        $this->publishedAt = $publishedAt;

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
     *
     * @return ArticleInterface
     */
    public function setImage(ArticleImageInterface $image)
    {
        $this->image = $image;

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
        return $this->getTranslation()->getMetaKeywords();
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->getTranslation()->getMetaDescription();
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
     *
     * @return ArticleInterface
     */
    public function setCategory(ArticleCategoryInterface $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param ArrayCollection $products
     *
     * @return ArticleInterface
     */
    public function setProducts(ArrayCollection $products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @param ProductInterface $product
     *
     * @return ArticleInterface
     */
    public function addProduct(ProductInterface $product)
    {
        $this->products->add($product);

        return $this;
    }

    /**
     * @param ProductInterface $product
     *
     * @return ArticleInterface
     */
    public function removeProduct(ProductInterface $product)
    {
        $this->products->removeElement($product);

        return $this;
    }

    /**
     * @return ArticleTranslationInterface
     */
    public function createTranslation()
    {
        return new ArticleTranslation();
    }
}
