<?php

namespace Webburza\Sylius\ArticleBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleCategoryType extends AbstractResourceType
{
    /**
     * Build the Article Category form
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('translations', 'a2lix_translationsForms', [
            'form_type' => 'webburza_article_category_translation',
            'label'    => 'webburza.sylius.article_category.translations'
        ]);

        $builder->add('published', Type\CheckboxType::class, [
            'label' => 'webburza.sylius.article_category.label.published'
        ]);
    }

    public function getName()
    {
        return 'webburza_article_category';
    }
}
