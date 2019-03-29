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
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class TricksController extends AbstractController
{

    const LIMIT = 8;
    /**
     * @var TrickRepository
     */
    private $repository;

    public function __construct(TrickRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route(path="/tricks", name="tricks")
     * @return Response
     */
    public function index(): Response
    {
        $tricks = $this->repository->getTricksByLimit(0, self::LIMIT);

        return $this->render('tricks/trick.html.twig', [
            'tricks' => $tricks,
            'current_menu' => 'tricks'
        ]);
    }

    /**
     * @Route("/ajax/tricks/{page}", name="trick.index", requirements={"page"="\d+"}, defaults={"page": 1})
     * @param int $page
     * @return Response
     */
    public function ajaxAction($page = 1) {

        $encoder = new JsonEncoder();
        $normalizer = new GetSetMethodNormalizer();
        $serializer = new Serializer([$normalizer], [$encoder]);

        $offset = ($page - 1) * self::LIMIT;
        $totalTrickCount = $this->repository->countTricks();
        $tricks = $this->repository->getTricksByLimit($offset, self::LIMIT);
        $tricksCount = count($tricks);
        dump($tricks);



        $data = [
            'nextPage' => $page + 1,
        ];

        foreach ($tricks as $trick)
        {
            $data['tricks'][] = [
                'title' => $trick->getTitle(),
                'image' => $trick->getImage(),
                'content' => $trick->getContent(),
                'category' => $trick->getCategory()->getName(),
                'author' => $trick->getAuthor()->getRealname(),
            ];
        }

        return new Response($serializer->serialize($data, 'json', [
            'circular_reference_limit' => 0,
            'ignored_attributes' => ['password'],
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]), 200, ['Content-Type' => 'application/json']);
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


        $comments = $commentRepository->findByOrder();

        return $this->render('tricks/show.html.twig', [
            'trick' => $trick,
            'current_menu' => 'tricks',
            'comments' => $comments,
            'form' => $form->createView()
        ]);
    }

}