<?php
namespace Webburza\Sylius\ArticleBundle\EventListener;

use Sylius\Bundle\WebBundle\Event\MenuBuilderEvent;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\Translation\Translator;

class FrontendMenuBuilderListener
{
    /**
     * @var Translator
     */
    private $translator;

    public function __construct(DataCollectorTranslator $translator)
    {
        $this->translator = $translator;
    }

    public function addFrontendMenuItems(MenuBuilderEvent $event)
    {
        $menu = $event->getMenu();

        $menu->addChild('webburza_sylius_articles_front', [
            'route' => 'webburza_article_frontend_index',
            'linkAttributes' => [
                'title' => $this->translator->trans('webburza.sylius.article.index_header')
            ],
            'labelAttributes' => [
                'icon' => 'icon-file-text icon-large',
                'iconOnly' => false
            ],
        ])->setLabel($this->translator->trans('webburza.sylius.article.frontend.articles'));
    }
}
