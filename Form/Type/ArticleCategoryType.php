<?php

namespace Webburza\Sylius\ArticleBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

final class ArticleCategoryType extends AbstractResourceType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('translations', ResourceTranslationsType::class, [
            'entry_type'  => ArticleCategoryTranslationType::class,
            'label' => 'webburza_article.article_category.translations'
        ]);

        $builder->add('published', CheckboxType::class, [
            'label' => 'webburza_article.article_category.label.published'
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'webburza_article_category';
    }
}
