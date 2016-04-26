<?php

namespace Webburza\Sylius\ArticleBundle\Command;

use Sylius\Component\Rbac\Model\Permission;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InstallCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('webburza:sylius-article-bundle:install')
            ->setDescription("Installs the bundle, creates required database tables.")
            ->setHelp("Usage:  <info>$ bin/console webburza:sylius-article-bundle:install</info>")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var \Doctrine\ORM\EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        $output->writeln('<info>Creating article tables...</info>');
        $this->createArticleTables($manager);

        $output->writeln('<info>Creating permissions...</info>');
        $this->createPermissions($manager);

        $output->writeln('<info>Installation complete.</info>');
    }

    /**
     * Create article tables.
     *
     * @param $manager
     */
    private function createArticleTables($manager)
    {
        $queries = [
            'CREATE TABLE webburza_sylius_article (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, published TINYINT(1) NOT NULL, featured TINYINT(1) NOT NULL, published_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_9FD397A312469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB',
            'CREATE TABLE webburza_sylius_article_category (id INT AUTO_INCREMENT NOT NULL, published TINYINT(1) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB',
            'CREATE TABLE webburza_sylius_article_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, lead LONGTEXT DEFAULT NULL, content LONGTEXT DEFAULT NULL, meta_keywords LONGTEXT DEFAULT NULL, meta_description LONGTEXT DEFAULT NULL, active TINYINT(1) NOT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_B49ACC0B2C2AC5D3 (translatable_id), UNIQUE INDEX webburza_sylius_article_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB',
            'CREATE TABLE webburza_sylius_article_image (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, path VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_710599397294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB',
            'CREATE TABLE webburza_sylius_article_category_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_1B9F69192C2AC5D3 (translatable_id), UNIQUE INDEX webburza_sylius_article_category_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB',
            'ALTER TABLE webburza_sylius_article ADD CONSTRAINT FK_9FD397A312469DE2 FOREIGN KEY (category_id) REFERENCES webburza_sylius_article_category (id)',
            'ALTER TABLE webburza_sylius_article_translation ADD CONSTRAINT FK_B49ACC0B2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES webburza_sylius_article (id) ON DELETE CASCADE',
            'ALTER TABLE webburza_sylius_article_image ADD CONSTRAINT FK_710599397294869C FOREIGN KEY (article_id) REFERENCES webburza_sylius_article (id) ON DELETE CASCADE',
            'ALTER TABLE webburza_sylius_article_category_translation ADD CONSTRAINT FK_1B9F69192C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES webburza_sylius_article_category (id) ON DELETE CASCADE'
        ];

        $manager->beginTransaction();

        foreach ($queries as $query) {
            $statement = $manager->getConnection()->prepare($query);
            $statement->execute();
        }

        $manager->commit();
    }

    /**
     * Create all required permission entries.
     *
     * @param $manager
     */
    private function createPermissions($manager)
    {
        $repository = $this->getContainer()->get('sylius.repository.permission');

        // Get parent node (used for content)
        $contentPermission = $repository->findOneBy(['code' => 'sylius.content']);

        // Create permissions
        $articleManagePermission = $this->createArticlePermissions($contentPermission);
        $articleCategoryManagePermission = $this->createArticleCategoryPermissions($contentPermission);

        // Persist the permissions
        $manager->persist($articleManagePermission);
        $manager->persist($articleCategoryManagePermission);
        $manager->flush();
    }

    /**
     * Create permissions for Article resource.
     *
     * @param Permission $parentPermission
     * @return Permission
     */
    private function createArticlePermissions($parentPermission)
    {
        // Create main permissions node
        $managePermission = new Permission();
        $managePermission->setCode('webburza.manage.article');
        $managePermission->setDescription('Manage articles');
        $managePermission->setParent($parentPermission);

        // Define permissions
        $permissions = [
            'webburza.article.show' => 'Show article',
            'webburza.article.index' => 'List articles',
            'webburza.article.create' => 'Create article',
            'webburza.article.update' => 'Update article',
            'webburza.article.delete' => 'Delete article',
            'webburza.article_image.delete' => 'Delete article image'
        ];

        // Create each permission
        foreach ($permissions as $code => $description) {
            $permission = new Permission();
            $permission->setCode($code);
            $permission->setDescription($description);

            $managePermission->addChild($permission);
        }

        return $managePermission;
    }

    /**
     * Create permissions for Article Category resource.
     *
     * @param Permission $parentPermission
     * @return Permission
     */
    private function createArticleCategoryPermissions(Permission $parentPermission)
    {
        // Create main permissions node
        $managePermission = new Permission();
        $managePermission->setCode('webburza.manage.article_category');
        $managePermission->setDescription('Manage article categories');
        $managePermission->setParent($parentPermission);

        // Define permissions
        $permissions = [
            'webburza.article_category.show' => 'Show article category',
            'webburza.article_category.index' => 'List article categories',
            'webburza.article_category.create' => 'Create article category',
            'webburza.article_category.update' => 'Update article category',
            'webburza.article_category.delete' => 'Delete article category'
        ];

        // Create each permission
        foreach ($permissions as $code => $description) {
            $permission = new Permission();
            $permission->setCode($code);
            $permission->setDescription($description);

            $managePermission->addChild($permission);
        }

        return $managePermission;
    }
}
