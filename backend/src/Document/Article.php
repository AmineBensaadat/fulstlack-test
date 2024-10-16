<?php
// src/Document/Article.php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Article
{
    /** @MongoDB\Id */
    private $id;

    /** @MongoDB\Field */
    private $title;

    /** @MongoDB\Field */
    private $content;

    /** @MongoDB\Field(type="string") */
    private $authorId;

    /** @MongoDB\Field(type="date") */
    private $publishedAt;

    // Getters and Setters

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function setAuthorId(string $authorId)
    {
        $this->authorId = $authorId;
    }

    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt)
    {
        $this->publishedAt = $publishedAt;
    }
}
