<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentType;
use App\Repository\TrickRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TricksController extends AbstractController
{
    /**
     * @var TrickRepository
     */
    private $repository;

    public function __construct(TrickRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/tricks", name="trick.index" )
     * @method Trick[]    findAll()
     * @return Response
     */
    public function index(): Response
    {
        $tricks = $this->repository->findAll();

        return $this->render('tricks/trick.html.twig', [
            'tricks' => $tricks,
            'current_menu' => 'tricks'
        ]);
    }


    /**
     * @Route("/tricks/{slug}-{id}", name="trick.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Trick $trick
     * @param string $slug
     * @param Request $request
     * @param ObjectManager $em
     * @return Response
     * @throws \Exception
     */
    public function show(Trick $trick, string $slug, Request $request, ObjectManager $em): Response
    {
       if($trick->getSlug() !== $slug)
       {
           return $this->redirectToRoute ('trick.show', [
               'id' => $trick->getId(),
               'slug' => $trick->getSlug()
           ], 301);
       }

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreationDate(new \DateTime('now'))
                    ->setTrick($trick);
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('trick.show', [
                'id' => $trick->getId(),
                'slug' => $trick->getSlug()
                ]);
        }

        return $this->render('tricks/show.html.twig', [
            'trick' => $trick,
            'current_menu' => 'tricks',
            'form' => $form->createView()
        ]);
    }

}