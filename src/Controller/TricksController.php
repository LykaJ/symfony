<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Knp\Component\Pager\PaginatorInterface;
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
     * @var PaginatorInterface
     * @var Request
     * @method Trick[]    findAll()
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $tricks = $paginator->paginate(
            $this->repository->findAll(),
            $request->query->getInt('page', '1'), 8
        );
        return $this->render('tricks/trick.html.twig', [
            'tricks' => $tricks,
            'current_menu' => 'tricks'
        ]);
    }

    /**
     * @Route("/tricks/{slug}-{id}", name="trick.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Trick $trick, string $slug): Response
    {
       if($trick->getSlug() !== $slug)
       {
           return $this->redirectToRoute ('trick.show', [
               'id' => $trick->getId(),
               'slug' => $trick->getSlug()
           ], 301);
       }
        return $this->render('tricks/show.html.twig', [
            'trick' => $trick,
            'current_menu' => 'tricks'
        ]);
    }

}