<?php
// src/Repository/ArticleRepository.php
namespace App\Repository;

use App\Document\Article;
use Doctrine\ODM\MongoDB\DocumentRepository;

class ArticleRepository extends DocumentRepository
{
    // Add custom query methods if needed
    public function findByAuthorId(string $authorId)
    {
        return $this->createQueryBuilder()
            ->field('authorId')->equals($authorId)
            ->getQuery()
            ->execute();
    }
}
