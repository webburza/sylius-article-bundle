<?php

namespace Webburza\Sylius\ArticleBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\NotBlankValidator;

/**
 * @Annotation
 */
class NotBlankIfActiveValidator extends NotBlankValidator
{
    /**
     * Perform NotBlank validation only if the 'active' property has been set to true.
     *
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if ($this->context->getObject()->isActive()) {
            parent::validate($value, $constraint);
        }
    }
}
