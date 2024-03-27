<?php

namespace App\Controller;

use App\Entity\Square;
use App\Repository\SquareRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SquareController extends AbstractController
{
    public function __construct(private SquareRepository $squareRepository)
    {
        $this->squareRepository = $squareRepository;
    }

    #[Route('/square', name: 'app_square_list', methods: 'GET')]
    public function list(): JsonResponse
    {
        $squares =  $this->squareRepository->findAll();

        return $this->json(['squares' => $squares]);
    }

    #[Route('/square/{id}', name: 'app_square_show',requirements:['id' => '\d+'], methods: 'GET')]
    public function show(int $id): JsonResponse
    {
        $square =  $this->squareRepository->find($id);

        if ($square === null) {

            return $this->json(['message' => 'nie ma takiego kwadratu']);
        }

        return $this->json(['square' => $square]);
    }


    #[Route('/square', name: 'app_square_create', methods: 'POST')]
    public function createCircle(ValidatorInterface $validator): JsonResponse
    {

        $content = (Request::createFromGlobals())->toArray();

        $square = new Square();

        $square->setSideLenght($content['sideLenght'])->setSurface()->setPerimeter();

        $errors = $validator->validate($square);

        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return $this->json(['error_message' => $errorsString]);
        }

        $this->squareRepository->save($square);

        return $this->json([
            'message' => 'Hejka udalo sie zarejestrowac kwadrat ' . $square->getId(),
        ]);
    }
    #[Route('square/{id}', name: 'app_square_edit', methods: 'PUT')]
    public function editSquare(ValidatorInterface $validator, int $id): JsonResponse
    {

        $content = (Request::createFromGlobals())->toArray();

        $square = $this->squareRepository->find($id);

        if ($square === null) {

            return $this->json(['message' => 'nie ma takiego kwadratu']);
        }

        $square->setSideLenght($content['sideLenght'])->setSurface()->setPerimeter();

        $errors = $validator->validate($square);

        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return $this->json(['error_message' => $errorsString]);
        }

        $this->squareRepository->save($square);

        return $this->json([
            'message' => 'Hejka udalo sie edytować kwadrat' . $square->getId(),
        ]);
    }

    #[Route('/square/{id}', name: 'app_square_delete', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {

        $square = $this->squareRepository->find($id);

        if ($square === null) {

            return $this->json(['message' => 'nie ma takiego kwadratu']);
        }
        $squareId = $square->getId();

        $this->squareRepository->delete($square);

        return $this->json([
            'message' => 'Usunieto okrag : ' . $squareId
        ]);
    }
   
}
