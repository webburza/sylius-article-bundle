<?php
namespace Webburza\Sylius\ArticleBundle\EventListener;

use DateTime;
use Sylius\Component\Resource\Event\ResourceEvent;
use Sylius\Component\Resource\Exception\UnexpectedTypeException;
use Webburza\Sylius\ArticleBundle\Entity\Article;

class PublishedListener
{
    public function setPublishedAt(ResourceEvent $event)
    {
        /** @var Article $subject */
        $subject = $event->getSubject();

        if (!$subject instanceof Article) {
            throw new UnexpectedTypeException($subject, 'Webburza\Sylius\ArticleBundle\Entity\Article');
        }

        if ($subject->isPublished() && $subject->getPublishedAt() == null) {
            $subject->setPublishedAt(new DateTime());
        }
    }
}
