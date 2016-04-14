<?php

namespace Webburza\Sylius\ArticleBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleTranslationType extends AbstractResourceType
{
    /**
     * Build the Article form
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', Type\TextType::class, [
            'label' => 'webburza.sylius.article.label.title'
        ]);

        $builder->add('lead', Type\TextareaType::class, [
            'label' => 'webburza.sylius.article.label.lead',
            'attr' => ['rows' => 4]
        ]);

        $builder->add('content', Type\TextareaType::class, [
            'label' => 'webburza.sylius.article.label.content',
            'attr' => ['class' => 'ckeditor']
        ]);

        $builder->add('active', Type\CheckboxType::class, [
            'label' => 'webburza.sylius.article.label.active'
        ]);

        $builder->add('metaKeywords', Type\TextareaType::class, [
            'label' => 'webburza.sylius.article.label.meta_keywords',
            'attr' => ['rows' => 2]
        ]);

        $builder->add('metaDescription', Type\TextareaType::class, [
            'label' => 'webburza.sylius.article.label.meta_description',
            'attr' => ['rows' => 2]
        ]);
    }

    public function getName()
    {
        return 'webburza_article_translation';
    }
}
