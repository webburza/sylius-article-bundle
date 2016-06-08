<?php

namespace Webburza\Sylius\ArticleBundle\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

interface ArticleTranslationInterface extends ResourceInterface, TranslationInterface
{
    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     * @return ArticleTranslationInterface
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getSlug();

    /**
     * @param string $slug
     * @return ArticleTranslationInterface
     */
    public function setSlug($slug);

    /**
     * @return string
     */
    public function getLead();

    /**
     * @param string $lead
     * @return ArticleTranslationInterface
     */
    public function setLead($lead);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param string $content
     * @return ArticleTranslationInterface
     */
    public function setContent($content);

    /**
     * @return boolean
     */
    public function isActive();

    /**
     * @param boolean $active
     * @return ArticleTranslationInterface
     */
    public function setActive($active);

    /**
     * @return string
     */
    public function getMetaKeywords();

    /**
     * @param string $metaKeywords
     * @return ArticleTranslationInterface
     */
    public function setMetaKeywords($metaKeywords);

    /**
     * @return string
     */
    public function getMetaDescription();

    /**
     * @param string $metaDescription
     * @return ArticleTranslationInterface
     */
    public function setMetaDescription($metaDescription);
}
