<?php

namespace App\Controller;

use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    #[Route('/', name: 'welcome')]
    public function index(TypeRepository $typeRepository): Response
    {
        $types = $typeRepository->findAll();
        return $this->render('welcome/index.html.twig', [
            'types' => $types,
        ]);
    }
}
