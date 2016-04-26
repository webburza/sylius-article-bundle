<?php

namespace Webburza\Sylius\ArticleBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class WebburzaSyliusArticleExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('webburza.sylius.article_bundle.slug', $config['slug']);

        $container->setParameter(
            'webburza.sylius.article_bundle.file_browser.browse_url',
            $config['file_browser']['browse_url']
        );

        $container->setParameter(
            'webburza.sylius.article_bundle.file_browser.upload_url',
            $config['file_browser']['upload_url']
        );

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
