<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MoviesController extends AbstractController
{
    public function __construct(
        private MovieRepository $movieRepository,
        private SerializerInterface $serializer
    ) {}

    #[Route('/movies', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $movies = $this->movieRepository->findAll();
        $data = $this->serializer->serialize($movies, "json", ["groups" => "default"]);

        return new JsonResponse($data, json: true);
    }

    #[Route('/movies/rateASC', methods: ['GET'])]
    public function listRateAsc(): JsonResponse
    {
        $movies = $this->movieRepository->findBy(array(), array('rating' => 'ASC'));
        $data = $this->serializer->serialize($movies, "json", ["groups" => "default"]);

        return new JsonResponse($data, json: true);
    
    }

    #[Route('/movies/rateDESC', methods: ['GET'])]
    public function listRateDesc(): JsonResponse
    {
        $movies = $this->movieRepository->findBy(array(), array('rating' => 'DESC'));
        $data = $this->serializer->serialize($movies, "json", ["groups" => "default"]);

        return new JsonResponse($data, json: true);
    
    }

    #[Route('/movies/release', methods: ['GET'])]
    public function listReleaseDesc(): JsonResponse
    {
        $movies = $this->movieRepository->findBy(array(), array('year' => 'DESC'));
        $data = $this->serializer->serialize($movies, "json", ["groups" => "default"]);

        return new JsonResponse($data, json: true);
    
    }
}
