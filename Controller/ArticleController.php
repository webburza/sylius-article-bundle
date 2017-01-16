<?php

namespace Webburza\Sylius\ArticleBundle\Controller;

use FOS\RestBundle\View\View;
use Sylius\Component\Resource\ResourceActions;
use Symfony\Component\HttpFoundation\Request;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Webburza\Sylius\ArticleBundle\Model\ArticleCategoryInterface;
use Webburza\Sylius\ArticleBundle\Model\ArticleControllerInterface;
use Webburza\Sylius\ArticleBundle\Repository\ArticleRepositoryInterface;

class ArticleController extends ResourceController implements ArticleControllerInterface
{
    /**
     * @var ArticleRepositoryInterface
     */
    protected $repository;

    /**
     * Show publicly visible articles for the current locale.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexFrontAction(Request $request)
    {
        // Get request configuration
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        // Get the category if this is index by category
        if (false === ($category = $this->getCategoryFromRequest($request))) {
            throw $this->createNotFoundException();
        }

        // Get a paginator for publicly visible articles for locale
        $articles = $this->repository->getPublicPaginatorForLocale($request->getLocale(), $category);
        $articles->setMaxPerPage($configuration->getPaginationMaxPerPage());
        $articles->setCurrentPage($request->get('page', 1));

        // Get categories for listing
        $categories = $this->get('webburza_article.repository.article_category')->findPublic([
            'translation.title' => 'asc'
        ]);

        $view = View::create($articles);

        if ($configuration->isHtmlRequest()) {
            $view
                ->setTemplate('WebburzaSyliusArticleBundle:Frontend/Article:index.html.twig')
                ->setTemplateVar($this->metadata->getPluralName())
                ->setData([
                    'articles'   => $articles,
                    'categories' => $categories,
                    'category'   => $category
                ]);
        }

        return $this->viewHandler->handle($configuration, $view);
    }

    /**
     * Get a publicly visible article by slug, for the current locale.
     *
     * @param Request $request
     * @param $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showFrontAction(Request $request, $slug)
    {
        // Get request configuration
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        // Get a publicly visible article by translated slug
        $article = $this->repository->findPublicBySlug($slug, $request->getLocale());

        if (!$article) {
            throw $this->createNotFoundException();
        }

        // Get categories for listing
        $categories = $this->get('webburza_article.repository.article_category')->findBy([
            'published' => true
        ]);

        // Get related articles
        $relatedArticles =
            $this->get('webburza_article.repository.article')
                 ->getRelatedArticles($article, $request->getLocale(), 4);

        $this->eventDispatcher->dispatch(ResourceActions::SHOW, $configuration, $article);

        $view = View::create($article);
        if ($configuration->isHtmlRequest()) {
            $view
                ->setTemplate('WebburzaSyliusArticleBundle:Frontend/Article:show.html.twig')
                ->setData([
                    'article'         => $article,
                    'categories'      => $categories,
                    'relatedArticles' => $relatedArticles
                ]);
        }

        return $this->viewHandler->handle($configuration, $view);
    }

    /**
     * @param Request $request
     *
     * @return ArticleCategoryInterface|bool
     */
    protected function getCategoryFromRequest(Request $request)
    {
        if ($request->get('categorySlug')) {
            $category = $this->get('webburza_article.repository.article_category')->findPublicBySlug(
                $request->get('categorySlug'), $request->getLocale()
            );

            return $category ?: false;
        }

        return null;
    }
}
