<?php
// src/Repository/UserRepository.php
namespace App\Repository;

use App\Document\User;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class UserRepository extends DocumentRepository
{
    public function findByEmail(string $email): ?User
    {
        return $this->createQueryBuilder()
            ->field('email')->equals($email)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
