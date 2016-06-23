<?php
namespace Webburza\Sylius\ArticleBundle\EventListener;

use Sylius\Bundle\WebBundle\Event\MenuBuilderEvent;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\TranslatorInterface;

class MenuBuilderListener
{
    /**
     * @var Translator
     */
    protected $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function addBackendMenuItems(MenuBuilderEvent $event)
    {
        $menu = $event->getMenu();

        if (isset($menu['content'])) {
            $menu['content']
                ->addChild('webburza_sylius_articles', array(
                    'route'           => 'webburza_article_index',
                    'labelAttributes' => array('icon' => 'glyphicon glyphicon-file'),
                ))
                ->setLabel($this->translator->trans('webburza.sylius.article.backend.articles'));

            $menu['content']
                ->addChild('webburza_sylius_article_categories', array(
                    'route'           => 'webburza_article_category_index',
                    'labelAttributes' => array('icon' => 'glyphicon glyphicon-tags'),
                ))
                ->setLabel($this->translator->trans('webburza.sylius.article_category.backend.article_categories'));
        }
    }
}
