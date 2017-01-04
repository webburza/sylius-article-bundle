<?php

namespace Webburza\Sylius\ArticleBundle\Form\Type;

use Sylius\Bundle\CoreBundle\Form\Type\ImageType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

final class ArticleImageType extends ImageType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', FileType::class, [
            'label'         => 'webburza.sylius.article.label.file'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'webburza_article_image';
    }
}
