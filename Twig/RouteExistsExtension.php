<?php

namespace Webburza\Sylius\ArticleBundle\Twig;

use Symfony\Component\Routing\RouterInterface;

class RouteExistsExtension extends \Twig_Extension
{
    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * RouteExistsExtension constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('route_exists', array($this, 'routeExists')),
        );
    }

    public function routeExists($routeName)
    {
        return (null === $this->router->getRouteCollection()->get($routeName)) ? false : true;
    }

    public function getName()
    {
        return 'route_exists';
    }
}
