<?php

namespace Webburza\Sylius\ArticleBundle\EventListener;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

class MenuBuilderListener
{
    /**
     * @param MenuBuilderEvent $event
     */
    public function addBackendMenuItems(MenuBuilderEvent $event)
    {
        $menu = $event->getMenu();

        // Get or create the parent group
        if (null == ($contentMenu = $menu->getChild('content'))) {
            $contentMenu = $menu->addChild('content')->setLabel('webburza_article.ui.content');
        }

        // Add 'Articles' menu item
        $contentMenu->addChild('webburza_articles', ['route' => 'webburza_article_admin_article_index'])
                    ->setLabel('webburza_article.ui.articles')
                    ->setLabelAttribute('icon', 'file');

        // Add 'Article Categories' menu item
        $contentMenu->addChild('webburza_article_categories', ['route' => 'webburza_article_admin_article_category_index'])
                    ->setLabel('webburza_article.ui.article_categories')
                    ->setLabelAttribute('icon', 'tags');
    }
}
