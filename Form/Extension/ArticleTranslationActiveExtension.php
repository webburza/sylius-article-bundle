<?php

namespace Webburza\Sylius\ArticleBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Webburza\Sylius\ArticleBundle\Form\Type\ArticleTranslationType;

class ArticleTranslationActiveExtension extends AbstractTypeExtension
{
    /**
     * @var array
     */
    protected $availableLocaleCodes;

    /**
     * @param int $availableLocaleCodes
     */
    public function __construct($availableLocaleCodes)
    {
        $this->availableLocaleCodes = $availableLocaleCodes;
    }

    /**
     * Replace 'active' checkbox with a hidden element,
     * as it is redundant if there is only one active locale.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (count($this->availableLocaleCodes) === 1) {
            $builder->remove('active');
            $builder->add('active', HiddenType::class, [ 'data' => "1" ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return ArticleTranslationType::class;
    }
}
