<?php


namespace App\Controller\Admin;


use App\Entity\Trick;
use App\Form\TrickType;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AdminTrickController extends AbstractController
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
     * @Route("/admin", name="admin.tricks.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function index()
    {
       $tricks = $this->repository->findAll ();
       return $this->render ('admin/tricks/index.html.twig', compact ('tricks'));
    }

    /**
     * @Route("/admin/{id}", name="admin.tricks.edit")
     * @param Trick $trick
     */

    public function edit(Trick $trick)
    {
        $form = $this->createForm (TrickType::class, $trick);
       return $this->render ('admin/tricks/edit.html.twig', [
           'trick' => $trick,
           'form' => $form->createView ()
       ]);
    }

}