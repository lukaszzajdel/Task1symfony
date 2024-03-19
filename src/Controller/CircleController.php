<?php

namespace App\Controller;

use App\Entity\Circle;
use App\Repository\CircleRepository;
use PhpParser\Builder\Method;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CircleController extends AbstractController
{
    private CircleRepository $circleRepository;

    public function __construct(CircleRepository $circleRepository)
    {
        $this->circleRepository = $circleRepository;
    }

    #[Route('/circle', name: 'app_circle_show', methods: 'GET')]
    public function index(SerializerInterface $serializer): //JsonResponse
    {
        #dokończyć
    //    $circles =  $this->circleRepository->findAll();

    //    $circlesJson = $serializer->encode($circles);
    //     return $this->json(['circles' => $circlesJson]);
    }

    #[Route('/circle', name: 'app_circle_create', methods: 'POST')]
    public function createCircle(ValidatorInterface $validator): JsonResponse
    {


        $content = (Request::createFromGlobals())->toArray();

        $circle = new Circle();

        $circle->setRadius($content['radius'])->setSurface()->setPerimeter();

        // $circle->setSurface();

        // $circle->setPerimeter();
        $errors = $validator->validate($circle);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return $this->json(['error_message' => $errorsString]);
        }

        $this->circleRepository->save($circle);

        return $this->json([
            'message' => 'Hejka udalo sie zarejestrowac ' . $circle->getId(),
        ]);
    }
}
