<?php

namespace Webburza\Sylius\ArticleBundle\Controller;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Webburza\Sylius\ArticleBundle\Doctrine\ORM\ArticleRepository;

class ArticleController extends ResourceController
{
    /**
     * Show publicly visible articles for the current locale.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexFrontAction()
    {
        // Get current locale
        $locale = $this->get('sylius.context.locale')->getCurrentLocale();

        /** @var ArticleRepository $repository */
        $repository = $this->getRepository();

        // Get a paginator for publicly visible articles for locale
        $articlesPaginator = $repository->getPublicPaginatorForLocale($locale);
        $articlesPaginator->setCurrentPage($this->get('request')->get('page', 1), true, true);
        $articlesPaginator->setMaxPerPage($this->config->getPaginationMaxPerPage());

        $view = $this
            ->view()
            ->setTemplate('WebburzaSyliusArticleBundle:Frontend:index.html.twig')
            ->setData(array(
                'articles' => $articlesPaginator
            ))
        ;

        return $this->handleView($view);
    }

    /**
     * Get a publicly visible article by slug, for the current locale.
     *
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showFrontAction($slug)
    {
        // Get current locale
        $locale = $this->get('sylius.context.locale')->getCurrentLocale();

        /** @var ArticleRepository $repository */
        $repository = $this->getRepository();

        // Get a publicly visible article by translated slug
        $article = $repository->findPublicBySlug($slug, $locale);

        if (!$article) {
            throw $this->createNotFoundException();
        }

        $view = $this
            ->view()
            ->setTemplate('WebburzaSyliusArticleBundle:Frontend:show.html.twig')
            ->setData(array(
                'article' => $article
            ))
        ;

        return $this->handleView($view);
    }
}
