<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\TemplateRenderer;
use App\Entity\Film;
use App\Repository\FilmRepository;
use App\Service\EntityMapper;


class FilmController
{
    private TemplateRenderer $renderer;

    public function __construct()
    {
        $this->renderer = new TemplateRenderer();
    }

    public function list(array $queryParams)
    {
        $filmRepository = new FilmRepository();
        $films = $filmRepository->findAll();

        /* $filmEntities = [];
        foreach ($films as $film) {
            $filmEntity = new Film();
            $filmEntity->setId($film['id']);
            $filmEntity->setTitle($film['title']);
            $filmEntity->setYear($film['year']);
            $filmEntity->setType($film['type']);
            $filmEntity->setSynopsis($film['synopsis']);
            $filmEntity->setDirector($film['director']);
            $filmEntity->setCreatedAt(new \DateTime($film['created_at']));
            $filmEntity->setUpdatedAt(new \DateTime($film['updated_at']));

            $filmEntities[] = $filmEntity;
        } */

        //dd($films);

        echo $this->renderer->render('film/list.html.twig', [
            'films' => $films,
        ]);

        // header('Content-Type: application/json');
        // echo json_encode($films);
    }







    public function create() : void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filmRepository = new FilmRepository();
            $entityMapper = new EntityMapper();
    
            // Mapper les données utilisateur vers une entité Film
            $film = $entityMapper->mapToEntity($_POST, Film::class);
            $film->setCreatedAt(new \DateTime()); // Ajout manuel du champ non présent dans $_POST
    
            $filmRepository->createFilm($film);
    
            header('Location: /film/list');
            exit();
        }
    
        echo $this->renderer->render('film/create.html.twig');
    }

    
    public function read(array $queryParams): void
    {
        $filmId = $queryParams['id'] ?? null;

        if (!$filmId || !is_numeric($filmId)) {
            echo $this->renderer->render('error.html.twig', [
                'message' => 'Invalid film ID.',
            ]);
            return;
        }

        $filmRepository = new FilmRepository();
        $film = $filmRepository->find((int)$filmId);

        if ($film !== null) {
            echo $this->renderer->render('film/read.html.twig', ['film' => $film]);
        } else {
            echo $this->renderer->render('error.html.twig', [
                'message' => 'Film not found.',
            ]);
        }
    }

    public function update(array $queryParams): void
    {
        $filmId = $queryParams['id'] ?? null;

        if (!$filmId || !is_numeric($filmId)) {
            echo $this->renderer->render('error.html.twig', [
                'message' => 'Invalid film ID.',
            ]);
            return;
        }

        $filmRepository = new FilmRepository();
        $film = $filmRepository->find((int)$filmId);

        if ($film === null) {
            echo $this->renderer->render('error.html.twig', [
                'message' => 'Film not found.',
            ]);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filmData = [
                'title' => htmlspecialchars(trim($_POST['title'] ?? '')),
                'year' => htmlspecialchars(trim($_POST['year'] ?? '')),
                'type' => htmlspecialchars(trim($_POST['type'] ?? '')),
                'synopsis' => htmlspecialchars(trim($_POST['synopsis'] ?? '')),
                'director' => htmlspecialchars(trim($_POST['director'] ?? '')),
            ];

            $film->setTitle($filmData['title'])
                 ->setYear($filmData['year'])
                 ->setType($filmData['type'])
                 ->setSynopsis($filmData['synopsis'])
                 ->setDirector($filmData['director'])
                 ->setUpdatedAt(new \DateTime());

            $filmRepository->updateFilm($film);

            header('Location: /film/list');
            exit();
        }

        echo $this->renderer->render('film/update.html.twig', ['film' => $film]);
    }

    public function delete(array $queryParams): void
    {
        $filmId = $queryParams['id'] ?? null;

        if (!$filmId || !is_numeric($filmId)) {
            echo $this->renderer->render('error.html.twig', [
                'message' => 'Invalid film ID.',
            ]);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filmRepository = new FilmRepository();
            $film = $filmRepository->find((int)$filmId);

            if ($film !== null) {
                $filmRepository->deleteFilm($film);
                header('Location: /film/list');
                exit();
            } else {
                echo $this->renderer->render('error.html.twig', [
                    'message' => 'Film not found.',
                ]);
                return;
            }
        }

        echo $this->renderer->render('film/delete.html.twig', ['id' => $filmId]);
    }

}
