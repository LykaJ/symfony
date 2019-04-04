<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentType;

use App\Repository\CommentRepository;

use App\Repository\TrickRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TricksController extends AbstractController
{

    const LIMIT = 8;
    const CMTLIMIT = 2;
    /**
     * @var TrickRepository
     */
    private $repository;

    public function __construct(TrickRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route(path="/tricks", name="trick.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('tricks/trick.html.twig', [
            'current_menu' => 'tricks'
        ]);
    }

    /**
     * @Route("/api/tricks/{page}", name="trick.async", requirements={"page"="\d+"}, defaults={"page": 1}, methods="GET")
     * @param int $page
     * @return Response
     */
    public function tricksAsync($page = 1)
    {
        $offset = ($page - 1) * self::LIMIT;
        $totalTrickCount = $this->repository->countTricks();
        $tricks = $this->repository->getTricksByLimit($offset, self::LIMIT);
        $tricksCount = count($tricks);
        $nextPage = $tricksCount + ($page - 1) * self::LIMIT < $totalTrickCount ? $page + 1 : null;

        $data = [
            'nextPage' => $nextPage,
            'content' => $this->renderView('tricks/_list.html.twig', ['tricks' => $tricks])
        ];

        return $this->json($data);
    }

    /**
     * @Route("/trick/{slug}-{id}", name="trick.show", requirements={"slug": "[a-z0-9\-]*"}, methods="GET|POST")
     * @param Trick $trick
     * @param string $slug
     * @param Request $request
     * @param ObjectManager $em
     * @param CommentRepository $commentRepository
     * @return Response
     * @throws \Exception
     */
    public function show(Trick $trick, string $slug, Request $request, ObjectManager $em, CommentRepository $commentRepository): Response

    {
        if ($trick->getSlug() !== $slug) {
            return $this->redirectToRoute('trick.show', [
                'id' => $trick->getId(),
                'slug' => $trick->getSlug()
            ], 301);
        }

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $comment->setCreationDate(new \DateTime('now'))
                ->setTrick($trick)
                ->setAuthor($user);
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('trick.show', [
                'id' => $trick->getId(),
                'slug' => $trick->getSlug()
            ]);
        }

        $comments = $commentRepository->findByTrick($trick);


        return $this->render('tricks/show.html.twig', [
            'trick' => $trick,
            'current_menu' => 'tricks',
            'comments' => $comments,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("api/trick/{slug}-{id}/{page}", name="trick.paginate", requirements={"slug": "[a-z0-9\-]*", "page"="\d+"}, defaults={"page": 1}, methods="GET|POST")
     * @param Trick $trick
     * @param CommentRepository $commentRepository
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function paginate(Trick $trick, CommentRepository $commentRepository, $page = 1)
    {
        $offset = ($page - 1) * self::CMTLIMIT;
        $totalCommentCount = $commentRepository->countComments($trick);
        $comments = $commentRepository->getCommentsByLimit($offset, self::CMTLIMIT);
        $commentCount = count($comments);
        $nextPage = $commentCount + ($page - 1) * self::CMTLIMIT < $totalCommentCount ? $page + 1 : null;


        $data = [
            'nextPage' => $nextPage,
            'content' => $this->renderView('comments/_list.html.twig', [
                'trick' => $trick,
                'comments' => $comments,
            ])
        ];

        return $this->json($data);
    }
}