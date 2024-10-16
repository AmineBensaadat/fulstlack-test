<?php
// src/Controller/ArticleController.php
namespace App\Controller;

use App\Document\Article;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    /**
     * @Route("/api/articles", methods={"POST"})
     */
    public function createArticle(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $article = new Article();
        $article->setTitle($data['title']);
        $article->setContent($data['content']);
        $article->setAuthorId($data['authorId']);
        $article->setPublishedAt(new \DateTime());

        $this->dm->persist($article);
        $this->dm->flush();

        return new JsonResponse(['id' => $article->getId()], JsonResponse::HTTP_CREATED);
    }

    /**
     * @Route("/api/articles/{id}", methods={"GET"})
     */
    public function getArticle(string $id): JsonResponse
    {
        $article = $this->dm->getRepository(Article::class)->find($id);
        if (!$article) {
            return new JsonResponse(['error' => 'Article not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse([
            'id' => $article->getId(),
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'authorId' => $article->getAuthorId(),
            'publishedAt' => $article->getPublishedAt()->format('Y-m-d H:i:s'),
        ]);
    }

    /**
 * @Route("/api/articles", methods={"GET"})
 */
public function getArticles(DocumentManager $dm): JsonResponse
{
    $articles = $dm->getRepository(Article::class)->findAll();
    return $this->json($articles);
}

/**
 * @Route("/api/articles/{id}", methods={"PUT"})
 */
public function updateArticle(Request $request, $id, DocumentManager $dm): JsonResponse
{
    $article = $dm->getRepository(Article::class)->find($id);

    if (!$article) {
        return new JsonResponse(['message' => 'Article not found'], 404);
    }

    $data = json_decode($request->getContent(), true);
    $article->setTitle($data['title'] ?? $article->getTitle());
    $article->setContent($data['content'] ?? $article->getContent());

    $dm->flush();

    return $this->json($article);
}

/**
 * @Route("/api/articles/{id}", methods={"DELETE"})
 */
public function deleteArticle($id, DocumentManager $dm): JsonResponse
{
    $article = $dm->getRepository(Article::class)->find($id);

    if (!$article) {
        return new JsonResponse(['message' => 'Article not found'], 404);
    }

    $dm->remove($article);
    $dm->flush();

    return new JsonResponse(['message' => 'Article deleted']);
}


}
