<?php

namespace Webburza\Sylius\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Image;
use Sylius\Component\Core\Model\ImageInterface;

/**
 * Class ArticleImage
 *
 * @ORM\Table(name="webburza_sylius_article_image")
 * @ORM\Entity()
 */
class ArticleImage extends Image implements ImageInterface
{
    /**
     * The associated article.
     *
     * @var Article
     * @ORM\OneToOne(targetEntity="Article", inversedBy="image")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $article;

    /**
     * Path to file
     *
     * @var string
     */
    protected $path;

    /**
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param Article $article
     * @return ArticleImage
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    public function getName()
    {
        return 'webburza_article_image';
    }
}
