<?php

namespace App\Controller;

use App\Entity\Circle;
use PhpParser\Builder\Method;
use App\Repository\CircleRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CircleController extends AbstractController
{


    public function __construct(private CircleRepository $circleRepository)
    {
        $this->circleRepository = $circleRepository;
    }

    #[Route('/circle', name: 'app_circle_list', methods: 'GET')]
    public function list() //JsonResponse
    {
        $circles =  $this->circleRepository->findAll();

        return $this->json(['circles' => $circles]);
    }


    #[Route('/circle/{id}', name: 'app_circle_show', requirements: ['id' => '\d+'], methods: 'GET')]
    public function show(int $id): JsonResponse
    {
        $circle =  $this->circleRepository->find($id);

        if ($circle === null) {

            return $this->json(['message' => 'nie ma takiego koła']);
        }

        return $this->json(['circle' => $circle]);
    }

    #[Route('/circle/{id}', name: 'app_circle_edit', methods: 'PUT')]
    public function editCircle(ValidatorInterface $validator, int $id): JsonResponse
    {

        $content = (Request::createFromGlobals())->toArray();

        $circle = $this->circleRepository->find($id);

        if ($circle === null) {

            return $this->json(['message' => 'nie ma takiego koła']);
        }

        $circle->setRadius($content['radius'])->setSurface()->setPerimeter();

        $errors = $validator->validate($circle);

        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return $this->json(['error_message' => $errorsString]);
        }

        $this->circleRepository->save($circle);

        return $this->json([
            'message' => 'Hejka udalo sie edytować okrąg' . $circle->getId(),
        ]);
    }

    #[Route('/circle/{id}', name: 'app_circle_delete', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {

        $circle = $this->circleRepository->find($id);

        if ($circle === null) {

            return $this->json(['message' => 'nie ma takiego koła']);
        }
        $circleId = $circle->getId();

        $this->circleRepository->delete($circle);

        return $this->json([
            'message' => 'Usunieto okrag : ' . $circleId
        ]);
    }


    #[Route('/circle', name: 'app_circle_create', methods: 'POST')]
    public function createCircle(ValidatorInterface $validator): JsonResponse
    {

        $content = (Request::createFromGlobals())->toArray();

        $circle = new Circle();

        $circle->setRadius($content['radius'])->setSurface()->setPerimeter();

        $errors = $validator->validate($circle);

        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return $this->json(['error_message' => $errorsString]);
        }

        $this->circleRepository->save($circle);

        return $this->json([
            'message' => 'Udalo sie zarejestrowac okrag' . $circle->getId(),
        ]);
    }
}
