<?php

namespace Webburza\Sylius\ArticleBundle\Model;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\HttpFoundation\Request;

interface ArticleControllerInterface extends ContainerAwareInterface
{
    /**
     * Show publicly visible articles for the current locale.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexFrontAction(Request $request);
}
