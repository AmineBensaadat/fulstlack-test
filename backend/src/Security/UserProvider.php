<?php
// src/Security/UserProvider.php
namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class UserProvider implements UserProviderInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->findByEmail($identifier);

        if (!$user) {
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $identifier));
        }

        return $user;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->userRepository->find($user->getId());
    }

    public function supportsClass(string $class): bool
    {
        return $class === User::class;
    }
}
