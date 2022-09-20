<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchFormType;
use App\Repository\ChallengeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(ChallengeRepository $challengeRepository, Request $request): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchFormType::class, $data);
        $form->handleRequest($request);
        $challengesSearch = $challengeRepository->findSearch($data);
        $challenges = $challengeRepository->findAll();
        return $this->render('home/index.html.twig', [
            'challenges' => $challenges,
            'challengesSearch' => $challengesSearch,
            'form' => $form->createView(),
        ]);
    }
}
