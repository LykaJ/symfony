<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentType;

use App\Repository\CommentRepository;

use App\Repository\TrickRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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
     * @Route("/tricks", name="trick.index")
     * @method Trick[]    findAll()
     * @return Response
     */
   /* public function index(): Response
    {
        $tricks = $this->repository->findAll();

        return $this->render('tricks/trick.html.twig', [
            'tricks' => $tricks,
            'current_menu' => 'tricks'
        ]);
    } */

    /**
     * @Route("/tricks/{page}", name="trick.index", requirements={"page"="\d+"}, defaults={"page": 1})
     * @param int $page
     * @return JsonResponse
     */
    public function ajaxAction($page = 1) {

       /* $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders); */


        $offset = ($page - 1) * self::LIMIT;
        $totalTrickCount = $this->repository->countTricks();
        $tricks = $this->repository->getTricksByLimit($offset, self::LIMIT);
        $tricksCount = count($tricks);
        dump($tricks);

        $nextPage = $tricksCount + ($page - 1) * self::LIMIT < $totalTrickCount ? $page + 1 : null;

       /* $data = $serializer->serialize([
            'tricks' => $tricks,
            'nextPage' => $nextPage
        ], 'json'); */

       $data = [
           'tricks' => $tricks,
           'nextPage' => $nextPage
       ];

        return new JsonResponse($data);
    }


    /**
     * @Route("/tricks/{slug}-{id}", name="trick.show", requirements={"slug": "[a-z0-9\-]*"}, methods="GET|POST")
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