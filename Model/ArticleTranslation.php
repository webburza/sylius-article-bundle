<?php

namespace Webburza\Sylius\ArticleBundle\Model;

use Sylius\Component\Resource\Model\AbstractTranslation;
use Symfony\Component\Validator\Constraints as Assert;
use Webburza\Sylius\ArticleBundle\Validator\Constraints;

class ArticleTranslation extends AbstractTranslation implements ArticleTranslationInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     * @Constraints\NotBlankIfActive()
     */
    protected $title;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $lead;

    /**
     * @var string
     * @Constraints\NotBlankIfActive()
     */
    protected $content;

    /**
     * @var string
     */
    protected $metaKeywords;

    /**
     * @var string
     */
    protected $metaDescription;

    /**
     * @var boolean
     */
    protected $active = true;

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
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return ArticleTranslationInterface
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return ArticleTranslationInterface
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * @param string $lead
     *
     * @return ArticleTranslationInterface
     */
    public function setLead($lead)
    {
        $this->lead = $lead;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return ArticleTranslationInterface
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     *
     * @return ArticleTranslationInterface
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @param string $metaKeywords
     *
     * @return ArticleTranslationInterface
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     *
     * @return ArticleTranslationInterface
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }
}
