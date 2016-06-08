<?php

namespace Webburza\Sylius\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Image;
use Webburza\Sylius\ArticleBundle\Model\ArticleImageInterface;
use Webburza\Sylius\ArticleBundle\Model\ArticleInterface;

/**
 * Class ArticleImage
 *
 * @ORM\Table(name="webburza_sylius_article_image")
 * @ORM\Entity()
 */
class ArticleImage extends Image implements ArticleImageInterface
{
    /**
     * The associated article.
     *
     * @var ArticleInterface
     * @ORM\OneToOne(targetEntity="Webburza\Sylius\ArticleBundle\Model\ArticleInterface", inversedBy="image")
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
     * @return ArticleInterface
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param ArticleInterface $article
     * @return ArticleImageInterface
     */
    public function setArticle(ArticleInterface $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'webburza_article_image';
    }
}
