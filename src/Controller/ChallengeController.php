<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Challenge;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/challenge', name: 'challenge_')]
class ChallengeController extends AbstractController
{
    #[Route('/{slug}', methods:['GET', 'POST'], name: 'show')]
    public function show(Challenge $challenge, Request $request, CommentRepository $commentRepository): Response
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $this->isGranted('ROLE_USER')) {
            $comment->setChallenge($challenge);
            $comment->setAuthor($this->getUser());
            $commentRepository->add($comment, true);
            $this-> addFlash('success', 'le commentaire vient d\'être ajouté');
            return $this->redirectToRoute('challenge_show', [
                'slug' => $challenge->getSlug()
            ]);
        }

        return $this->renderForm('challenge/show.html.twig', [
            'challenge' => $challenge,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}/comment/{id}', name: 'comment_delete', methods: ['GET','POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, Comment $comment, CommentRepository $commentRepository): Response
    {
        if ($comment->getAuthor() !== $this->getUser()) {
            $this->denyAccessUnlessGranted('Impossible de supprimer ce commentaire');
        }

        $challenge = $comment->getChallenge();
        if ($this->isCsrfTokenValid('delete' . $comment->getId(), $request->request->get('_token'))) {
            $commentRepository->remove($comment, true);
        }
        $this->addFlash('danger', 'Commentaire supprimé');
        return $this->redirectToRoute('challenge_show', [
            'slug' => $challenge->getSlug()
        ]);
    }
}
