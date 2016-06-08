<?php

namespace Webburza\Sylius\ArticleBundle\Controller;

use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Webburza\Sylius\ArticleBundle\Model\ArticleCategoryControllerInterface;
use Webburza\Sylius\ArticleBundle\Model\ArticleCategoryRepositoryInterface;
use Webburza\Sylius\ArticleBundle\Model\ArticleRepositoryInterface;

class ArticleCategoryController extends ResourceController implements ArticleCategoryControllerInterface
{
    /**
     * Get a publicly visible article category by slug, for the current locale.
     *
     * @param Request $request
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showFrontAction(Request $request, $slug)
    {
        // Get current locale
        $locale = $this->get('sylius.context.locale')->getCurrentLocale();

        // Get request configuration
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        /** @var ArticleCategoryRepositoryInterface $repository */
        $repository = $this->repository;

        // Get a publicly visible article by translated slug
        $category = $repository->findPublicBySlug($slug, $locale);

        if (!$category) {
            throw $this->createNotFoundException();
        }

        /** @var ArticleRepositoryInterface $repository */
        $repository = $this->get('webburza.repository.article');

        // Get a paginator for publicly visible articles for locale
        $articlesPaginator = $repository->getPublicPaginatorForLocale($locale, $category);
        $articlesPaginator->setCurrentPage($this->get('request')->get('page', 1), true, true);
        $articlesPaginator->setMaxPerPage($configuration->getPaginationMaxPerPage());

        // Get categories for listing
        $categories = $this->get('webburza.repository.article_category')->findBy([
            'published' => true
        ]);

        // Create the view
        $view = View::create();

        // Set template and data
        $view->setTemplate('WebburzaSyliusArticleBundle:Frontend/Category:show.html.twig');
        $view->setData(array(
            'articles' => $articlesPaginator,
            'category' => $category,
            'categories' => $categories
        ));

        // Handle view
        return $this->viewHandler->handle($configuration, $view);
    }
}
