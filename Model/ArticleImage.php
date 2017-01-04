<?php

namespace Webburza\Sylius\ArticleBundle\Model;

use Sylius\Component\Core\Model\Image;

class ArticleImage extends Image implements ArticleImageInterface
{
    /**
     * @inheritdoc
     */
    protected $code = '';
}
