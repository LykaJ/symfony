<?php


namespace App\Controller\Admin;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Repository\TrickRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminTrickController extends AbstractController
{
    /**
     * @var TrickRepository
     */
    private $repository;
    private $em;

    public function __construct(TrickRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.tricks.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function index()
    {
       $tricks = $this->repository->findAll();
       return $this->render ('admin/tricks/index.html.twig', compact ('tricks'));
    }


    /**
     * @Route("/admin/create", name="admin.tricks.new")
     * @param Request $request
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function new(Request $request)
    {
        $trick = new Trick();
        $form = $this->createForm (TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($trick);
            $this->em->flush();
            $this->addFlash('success', 'Le trick a bien été créé');
            return $this->redirectToRoute('admin.tricks.index');
        }

        return $this->render ('admin/tricks/new.html.twig', [
            'trick' => $trick,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.tricks.edit", methods="GET|POST")
     * @param Trick $trick
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function edit(Trick $trick, Request $request)
    {
        $form = $this->createForm (TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
            $this->addFlash('success', 'Le trick a bien été modifié');
            return $this->redirectToRoute('admin.tricks.index');
        }

       return $this->render ('admin/tricks/edit.html.twig', [
           'trick' => $trick,
           'form' => $form->createView()
       ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.tricks.delete", methods="DELETE")
     * @param Trick $trick
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Trick $trick, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $trick->getId(), $request->get('_token'))){
            $this->em->remove($trick);
            $this->em->flush();
            $this->addFlash('success', 'Le trick a bien été supprimé');
        }
        return $this->redirectToRoute('admin.tricks.index');
    }
}