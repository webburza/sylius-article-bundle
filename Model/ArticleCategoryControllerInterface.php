<?php

namespace Webburza\Sylius\ArticleBundle\Model;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\HttpFoundation\Request;

interface ArticleCategoryControllerInterface extends ContainerAwareInterface
{
    /**
     * Get a publicly visible article category by slug, for the current locale.
     *
     * @param Request $request
     * @param $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showFrontAction(Request $request, $slug);
}
