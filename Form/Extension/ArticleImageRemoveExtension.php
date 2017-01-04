<?php

namespace Webburza\Sylius\ArticleBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Webburza\Sylius\ArticleBundle\Form\Type\ArticleType;

class ArticleImageRemoveExtension extends AbstractTypeExtension
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('imageRemove', HiddenType::class, [
            'mapped' => false,
            'allow_extra_fields' => true
        ]);

        // Remove the Image from the Article if requested
        $builder->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) {
            if ($event->getForm()->get('imageRemove')->getData()) {
                $event->getData()->clearImage();
            }
        });
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return ArticleType::class;
    }
}
