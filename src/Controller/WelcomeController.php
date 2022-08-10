<?php

namespace App\Controller;

use App\Repository\LanguageRepository;
use App\Repository\LevelRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    #[Route('/', name: 'welcome')]
    public function index(
        TypeRepository $typeRepository,
        LanguageRepository $languageRepository,
        LevelRepository $levelRepository
    ): Response {
        $types = $typeRepository->findAll();
        $languages = $languageRepository->findAll();
        $levels = $levelRepository->findAll();
        return $this->render('welcome/index.html.twig', [
            'types' => $types,
            'languages' => $languages,
            'levels' => $levels,
        ]);
    }
}
