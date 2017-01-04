<?php
namespace Webburza\Sylius\ArticleBundle\EventListener;

use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Sylius\Component\Resource\Exception\UnexpectedTypeException;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webburza\Sylius\ArticleBundle\Model\ArticleInterface;

class ImageUploadListener
{
    /**
     * @var ImageUploaderInterface
     */
    protected $uploader;

    /**
     * @param ImageUploaderInterface $uploader
     */
    public function __construct(ImageUploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param GenericEvent $event
     */
    public function uploadArticleImage(GenericEvent $event)
    {
        /** @var ArticleInterface $subject */
        $subject = $event->getSubject();

        if (!$subject instanceof ArticleInterface) {
            throw new UnexpectedTypeException(
                $subject, 'Webburza\Sylius\ArticleBundle\Model\ArticleInterface'
            );
        }

        if ($subject->getImage() && $subject->getImage()->hasFile()) {
            $this->uploader->upload($subject->getImage());
        }
        elseif ($subject->getImage() && !$subject->getImage()->getPath()) {
            $subject->clearImage();
        }
    }
}
