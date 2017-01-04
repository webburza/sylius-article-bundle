<?php

namespace Webburza\Sylius\ArticleBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class ArticleCategoryTranslationType extends AbstractResourceType
{
    /**
     * Build the Article Category Translation form
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, [
            'label' => 'webburza_article.article_category.label.title'
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'webburza_article_category_translation';
    }
}
