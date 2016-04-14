<?php

namespace Webburza\Sylius\ArticleBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @Annotation
 */
class NotBlankIfActive extends NotBlank
{
    // ...
}
