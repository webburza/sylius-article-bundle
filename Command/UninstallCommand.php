<?php

namespace Webburza\Sylius\ArticleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UninstallCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('webburza:sylius-article-bundle:uninstall')
            ->setDescription("Uninstalls the bundle, removes bundle-specific database tables and permissions.")
            ->setHelp("Usage:  <info>$ bin/console webburza:sylius-article-bundle:uninstall</info>")
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var \Doctrine\ORM\EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        $output->writeln('<info>Removing article tables...</info>');
        $this->removeArticleTables($manager);

        $output->writeln('<info>Removing permissions...</info>');
        $this->removePermissions($manager);

        $output->writeln('<info>Uninstallation complete.</info>');
    }

    /**
     * Remove article tables.
     *
     * @param $manager
     */
    private function removeArticleTables($manager)
    {
        // Check if tables exist
        $schemaManager = $manager->getConnection()->getSchemaManager();

        // Skip if product group table does not exist
        if (!$schemaManager->tablesExist(['webburza_sylius_article'])) {
            return;
        }

        $queries = [
            'ALTER TABLE webburza_sylius_article_translation DROP FOREIGN KEY FK_B49ACC0B2C2AC5D3',
            'ALTER TABLE webburza_sylius_article_image DROP FOREIGN KEY FK_710599397294869C',
            'ALTER TABLE webburza_sylius_article DROP FOREIGN KEY FK_9FD397A312469DE2',
            'ALTER TABLE webburza_sylius_article_category_translation DROP FOREIGN KEY FK_1B9F69192C2AC5D3',
            'DROP TABLE webburza_sylius_article',
            'DROP TABLE webburza_sylius_article_category',
            'DROP TABLE webburza_sylius_article_translation',
            'DROP TABLE webburza_sylius_article_image',
            'DROP TABLE webburza_sylius_article_category_translation'
        ];

        $manager->beginTransaction();

        foreach ($queries as $query) {
            $statement = $manager->getConnection()->prepare($query);
            $statement->execute();
        }

        $manager->commit();
    }

    /**
     * Remove permission entries.
     *
     * @param $manager
     */
    private function removePermissions($manager)
    {
        $repository = $this->getContainer()->get('sylius.repository.permission');

        // Get the main node to remove
        $articleManagePermission = $repository->findOneBy(['code' => 'webburza.manage.article']);
        $articleCategoryManagePermission = $repository->findOneBy(['code' => 'webburza.manage.article_category']);

        if ($articleManagePermission) {
            // Remove permissions
            $manager->remove($articleManagePermission);
            $manager->remove($articleCategoryManagePermission);
            $manager->flush();
        }
    }
}
