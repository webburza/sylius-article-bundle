<?php

namespace Webburza\Sylius\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\AbstractTranslation;
use Symfony\Component\Validator\Constraints as Assert;
use Webburza\Sylius\ArticleBundle\Model\ArticleTranslationInterface;
use Webburza\Sylius\ArticleBundle\Validator\Constraints;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ArticleTranslation
 *
 * @ORM\Table(name="webburza_sylius_article_translation")
 * @ORM\Entity()
 */
class ArticleTranslation extends AbstractTranslation implements ArticleTranslationInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @Constraints\NotBlankIfActive()
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     * @Gedmo\Slug(fields={"title"}, unique_base="locale")
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="lead", type="text", nullable=true)
     */
    protected $lead;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     * @Constraints\NotBlankIfActive()
     */
    protected $content;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="text", nullable=true)
     */
    protected $metaKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="text", nullable=true)
     */
    protected $metaDescription;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    protected $active;

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
     * @return ArticleTranslationInterface
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }
}
