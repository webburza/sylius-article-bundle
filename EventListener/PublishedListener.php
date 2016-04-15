<?php
namespace Webburza\Sylius\ArticleBundle\EventListener;

use DateTime;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Resource\Event\ResourceEvent;
use Sylius\Component\Resource\Exception\UnexpectedTypeException;
use Webburza\Sylius\ArticleBundle\Entity\Article;

class PublishedListener
{
    /**
     * If the article is published, and has no publish date,
     * set it the the current datetime.
     *
     * @param ResourceControllerEvent $event
     * @throws UnexpectedTypeException
     */
    public function setPublishedAt(ResourceControllerEvent $event)
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
