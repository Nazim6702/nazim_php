<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use Twig\Environment;

class FilmController
{
    private $filmRepository;
    private $twig;

    public function __construct(FilmRepository $filmRepository, Environment $twig)
    {
        $this->filmRepository = $filmRepository;
        $this->twig = $twig;
    }

    public function listFilms(): void
    {
        // Récupérer les films depuis le repository
        $films = $this->filmRepository->findAll();

        // Afficher la vue Twig
        echo $this->twig->render('list.html.twig', [
            'films' => $films,
        ]);
    }
}
