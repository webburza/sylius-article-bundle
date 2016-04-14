<?php

namespace Webburza\Sylius\ArticleBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
class HasActiveTranslationValidator extends ConstraintValidator
{
    /**
     * Require at least one translation object to have the 'active'
     * property set to true.
     *
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        // Get the root element
        $root = $this->context->getRoot();

        // Check all translations
        foreach ($root->get('translations')->getData() as $translationItem) {
            if ($translationItem->isActive()) {
                return;
            }
        }

        // If no active translation was found, add violation
        $this->context->buildViolation($constraint->message)->addViolation();
    }
}
