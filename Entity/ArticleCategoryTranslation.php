<?php

namespace Webburza\Sylius\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\AbstractTranslation;
use Symfony\Component\Validator\Constraints as Assert;
use Webburza\Sylius\ArticleBundle\Model\ArticleCategoryTranslationInterface;
use Webburza\Sylius\ArticleBundle\Validator\Constraints;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Article
 *
 * @ORM\Table(name="webburza_sylius_article_category_translation")
 * @ORM\Entity()
 */
class ArticleCategoryTranslation extends AbstractTranslation implements ArticleCategoryTranslationInterface
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
     * @Assert\NotBlank()
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
     * @return ArticleCategoryTranslationInterface
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
     * @return ArticleCategoryTranslationInterface
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}
