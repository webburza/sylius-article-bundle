<?php

namespace Webburza\Sylius\ArticleBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class ArticleTranslationType extends AbstractResourceType
{
    /**
     * Build the Article form
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, [
            'label' => 'webburza_article.article.label.title'
        ]);

        $builder->add('lead', TextareaType::class, [
            'label' => 'webburza_article.article.label.lead',
            'attr'  => ['rows' => 4],
            'required' => false
        ]);

        $builder->add('content', TextareaType::class, [
            'label' => 'webburza_article.article.label.content',
            'attr'  => ['class' => 'ckeditor']
        ]);

        $builder->add('metaKeywords', TextareaType::class, [
            'label' => 'webburza_article.article.label.meta_keywords',
            'attr'  => ['rows' => 2],
            'required' => false
        ]);

        $builder->add('metaDescription', TextareaType::class, [
            'label' => 'webburza_article.article.label.meta_description',
            'attr'  => ['rows' => 2],
            'required' => false
        ]);

        $builder->add('active', CheckboxType::class, [
            'label' => 'webburza_article.article.label.active',
            'data'  => true
        ]);
    }

    public function getName()
    {
        return 'webburza_article_translation';
    }
}
