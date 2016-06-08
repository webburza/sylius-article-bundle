<?php

namespace Webburza\Sylius\ArticleBundle\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Core\Model\ImageInterface;

interface ArticleImageInterface extends ImageInterface, ResourceInterface
{
    /**
     * @return ArticleInterface
     */
    public function getArticle();

    /**
     * @param ArticleInterface $article
     * @return ArticleImageInterface
     */
    public function setArticle(ArticleInterface $article);

    /**
     * @return string
     */
    public function getName();
}
