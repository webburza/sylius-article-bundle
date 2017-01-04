<?php

namespace Webburza\Sylius\ArticleBundle\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

interface ArticleInterface extends ResourceInterface, TranslatableInterface
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
     * @return string
     */
    public function getLead();

    /**
     * @return string
     */
    public function getContent();

    /**
     * @return boolean
     */
    public function isPublished();

    /**
     * @param boolean $published
     *
     * @return ArticleInterface
     */
    public function setPublished($published);

    /**
     * @return boolean
     */
    public function isFeatured();

    /**
     * @param boolean $featured
     *
     * @return ArticleInterface
     */
    public function setFeatured($featured);

    /**
     * @return \DateTime
     */
    public function getPublishedAt();

    /**
     * @param \DateTime $publishedAt
     *
     * @return ArticleInterface
     */
    public function setPublishedAt(\DateTime $publishedAt = null);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @param \DateTime $createdAt
     *
     * @return ArticleInterface
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * @param \DateTime $updatedAt
     *
     * @return ArticleInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt);

    /**
     * @return ArticleImageInterface
     */
    public function getImage();

    /**
     * @param ArticleImageInterface $image
     *
     * @return ArticleInterface
     */
    public function setImage(ArticleImageInterface $image);

    /**
     * Remove the image.
     *
     * @return ArticleInterface
     */
    public function clearImage();

    /**
     * @return string
     */
    public function getMetaKeywords();

    /**
     * @return string
     */
    public function getMetaDescription();

    /**
     * @return ArticleCategoryInterface
     */
    public function getCategory();

    /**
     * @param ArticleCategoryInterface $category
     *
     * @return ArticleInterface
     */
    public function setCategory(ArticleCategoryInterface $category);

    /**
     * @return ArticleTranslationInterface
     */
    public function createTranslation();
}
