<?php

namespace Webburza\Sylius\ArticleBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Valid;

final class ArticleType extends AbstractResourceType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('translations', ResourceTranslationsType::class, [
            'entry_type'  => ArticleTranslationType::class,
            'label'       => 'webburza_article.article.translations',
            'constraints' => [
                new Valid()
            ]
        ]);

        $builder->add('image', ArticleImageType::class, [
            'label' => 'webburza_article.article.label.cover_image'
        ]);

        $builder->add('category', ArticleCategoryChoiceType::class, [
            'label' => 'webburza_article.article.label.category',
            'required' => false
        ]);

        $builder->add('products', ProductChoiceType::class, [
            'label'    => 'webburza_article.article.label.products',
            'attr'     => [
                'size' => 10
            ],
            'multiple' => true,
            'required' => false
        ]);

        $builder->add('featured', CheckboxType::class, [
            'label' => 'webburza_article.article.label.featured'
        ]);

        $builder->add('published', CheckboxType::class, [
            'label' => 'webburza_article.article.label.published'
        ]);

        $builder->add('publishedAt', DateTimeType::class, [
            'label'    => 'webburza_article.article.label.published_at',
            'date_widget' => 'single_text',
            'time_widget' => 'single_text',
            'required' => false
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'webburza_article';
    }
}
