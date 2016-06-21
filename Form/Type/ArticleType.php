<?php

namespace Webburza\Sylius\ArticleBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Valid;

class ArticleType extends AbstractResourceType
{
    /**
     * Build the Article form
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('translations', 'sylius_translations', [
            'type' => 'webburza_article_translation',
            'label' => 'webburza.sylius.article.translations',
            'constraints' => [
                new Valid()
            ]
        ]);

        $builder->add('image', 'webburza_article_image', [
            'label' => 'webburza.sylius.article.label.cover_image'
        ]);

        $builder->add('category', 'webburza_article_category_choice', [
            'label' => 'webburza.sylius.article.label.category'
        ]);

        $builder->add('products', 'webburza_article_product_choice', [
            'label' => 'webburza.sylius.article.label.products',
            'attr' => [
                'size' => 10
            ],
            'multiple' => true
        ]);

        $builder->add('publishedAt', 'datetime', [
            'label' => 'webburza.sylius.article.label.published_at',
            'required' => false,
            'date_format' => 'y-M-d',
            'date_widget' => 'choice',
            'time_widget' => 'text'
        ]);

        $builder->add('published', 'checkbox', [
            'label' => 'webburza.sylius.article.label.published'
        ]);

        $builder->add('featured', 'checkbox', [
            'label' => 'webburza.sylius.article.label.featured'
        ]);
    }

    public function getName()
    {
        return 'webburza_article';
    }
}
