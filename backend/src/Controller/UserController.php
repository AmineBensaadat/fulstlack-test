<?php
// src/Controller/UserController.php
namespace App\Controller;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    /**
     * @Route("/api/users", methods={"POST"})
     */
    public function createUser(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = new User();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword(password_hash($data['password'], PASSWORD_BCRYPT)); // Hash password

        $this->dm->persist($user);
        $this->dm->flush();

        return new JsonResponse(['id' => $user->getId()], JsonResponse::HTTP_CREATED);
    }

    /**
     * @Route("/api/users/{id}", methods={"GET"})
     */
    public function getUser(string $id): JsonResponse
    {
        $user = $this->dm->getRepository(User::class)->find($id);
        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse([
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ]);
    }

    /**
 * @Route("/api/users/{id}", methods={"PUT"})
 */
public function updateUser(Request $request, $id, DocumentManager $dm): JsonResponse
{
    $user = $dm->getRepository(User::class)->find($id);

    if (!$user) {
        return new JsonResponse(['message' => 'User not found'], 404);
    }

    $data = json_decode($request->getContent(), true);
    $user->setName($data['name'] ?? $user->getName());
    $user->setEmail($data['email'] ?? $user->getEmail());

    $dm->flush();

    return $this->json($user);
}

/**
 * @Route("/api/users/{id}", methods={"DELETE"})
 */
public function deleteUser($id, DocumentManager $dm): JsonResponse
{
    $user = $dm->getRepository(User::class)->find($id);

    if (!$user) {
        return new JsonResponse(['message' => 'User not found'], 404);
    }

    $dm->remove($user);
    $dm->flush();

    return new JsonResponse(['message' => 'User deleted']);
}


}
