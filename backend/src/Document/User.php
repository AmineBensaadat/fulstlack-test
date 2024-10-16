<?php
// src/Document/User.php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @MongoDB\Document
 */
class User implements UserInterface
{
    /** @MongoDB\Id */
    private $id;

    /** @MongoDB\Field */
    private $email;

    /** @MongoDB\Field */
    private $password;

    // Other fields can be added here...

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER']; // Adjust roles as needed
    }

    public function getSalt()
    {
        // Not needed for modern password hashing (bcrypt)
    }

    public function eraseCredentials()
    {
        // Clear any sensitive data if necessary
    }

    // New method to implement from UserInterface
    public function getUserIdentifier(): string
    {
        return $this->email; // Or any unique identifier for the user
    }
}
