<?php
namespace Webburza\Sylius\ArticleBundle\EventListener;

use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Sylius\Component\Resource\Exception\UnexpectedTypeException;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webburza\Sylius\ArticleBundle\Entity\Article;

class ImageUploadListener
{
    protected $uploader;

    public function __construct(ImageUploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    public function uploadArticleImage(GenericEvent $event)
    {
        /** @var Article $subject */
        $subject = $event->getSubject();

        if (!$subject instanceof Article) {
            throw new UnexpectedTypeException($subject, 'Webburza\Sylius\ArticleBundle\Entity\Article');
        }

        if ($subject->getImage()->hasFile()) {
            $this->uploader->upload($subject->getImage());
        }
        else {
            $subject->clearImage();
        }
    }
}
