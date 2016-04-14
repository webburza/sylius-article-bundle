<?php

namespace Webburza\Sylius\ArticleBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HasActiveTranslation extends Constraint
{
    public $message = "At least one active translation is required.";

    /**
     * Make this constraint a CLASS constraint.
     *
     * @return string|array One or more constant values
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
