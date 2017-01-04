<?php

namespace Webburza\Sylius\ArticleBundle\Model;

use Sylius\Component\Resource\Model\AbstractTranslation;
use Symfony\Component\Validator\Constraints as Assert;

class ArticleCategoryTranslation extends AbstractTranslation implements ArticleCategoryTranslationInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $title;

    /**
     * @var string
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
     *
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
     *
     * @return ArticleCategoryTranslationInterface
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}
