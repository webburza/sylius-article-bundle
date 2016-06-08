<?php

namespace Webburza\Sylius\ArticleBundle\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

interface ArticleCategoryTranslationInterface extends ResourceInterface, TranslationInterface
{
    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     * @return ArticleCategoryTranslationInterface
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getSlug();

    /**
     * @param string $slug
     * @return ArticleCategoryTranslationInterface
     */
    public function setSlug($slug);
}
