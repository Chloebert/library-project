<?php

namespace App\Controller\Api;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/books', name: 'api_books_')]
class BookController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(BookRepository $bookRepository): JsonResponse
    {
        $books = array_map(
            static fn ($book) => [
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'createdAt' => $book->getCreatedAt()->format(\DateTimeInterface::ATOM),
            ],
            $bookRepository->findAllOrderedByTitle()
        );

        return $this->json([
            'data' => $books,
        ]);
    }
}
