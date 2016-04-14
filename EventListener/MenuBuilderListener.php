<?php
namespace Webburza\Sylius\ArticleBundle\EventListener;

use Sylius\Bundle\WebBundle\Event\MenuBuilderEvent;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\Translation\Translator;

class MenuBuilderListener
{
    /**
     * @var Translator
     */
    private $translator;

    public function __construct(DataCollectorTranslator $translator)
    {
        $this->translator = $translator;
    }

    public function addBackendMenuItems(MenuBuilderEvent $event)
    {
        $menu = $event->getMenu();

        $menu['content']
            ->addChild('webburza_sylius_articles', array(
                'route'           => 'webburza_article_index',
                'labelAttributes' => array('icon' => 'glyphicon glyphicon-file'),
            ))
            ->setLabel($this->translator->trans('webburza.sylius.article.backend.articles'));

    }
}
