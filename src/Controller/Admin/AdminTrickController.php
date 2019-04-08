<?php


namespace App\Controller\Admin;

use App\Builder\TrickBuilder;
use App\Entity\ImageMedia;
use App\Entity\Trick;
use App\Entity\User;
use App\Event\AdminUploadTrickImageEvent;
use App\Event\MediaImagesUploadEvent;
use App\Form\TrickType;
use App\Repository\TrickRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
        return $this->render('admin/tricks/index.html.twig', compact('tricks'));
    }


    /**
     * @Route("/admin/create", name="admin.tricks.new")
     * @param Request $request
     * @param EventDispatcherInterface $event_dispatcher
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function create(Request $request, EventDispatcherInterface $event_dispatcher, TrickBuilder $trickBuilder)
    {
        $form = $this->createForm(TrickType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $trick = $trickBuilder->build($data)->getTrick();
            $event_dispatcher->dispatch(AdminUploadTrickImageEvent::NAME, new AdminUploadTrickImageEvent($trick));

            $currentUser = $this->get('security.token_storage')->getToken()->getUser();

            if ($currentUser instanceof User) {
                $trick->setAuthor($currentUser);
            }

            dd($trick);

            $event_dispatcher->dispatch(MediaImagesUploadEvent::IMAGE_UPLOAD, new MediaImagesUploadEvent($trick));

           /* $uploads_directory = $this->getParameter('media_directory');
            $files = $request->files->get('trick')['imageMedia'];

            dump($files);

            foreach ($files as $file)
            {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                // Move the file to the directory where brochures are stored
                $file->move(
                    $uploads_directory,
                    $fileName
                );
            } */


            $this->em->persist($trick);
            $this->em->flush();
            $this->addFlash('success', 'Le trick a bien été créé');

            if (!$form->isSubmitted() && !$form->isValid()) {
                $this->addFlash('error', 'Le trick n\'a pas pu être créé');
            }

            return $this->redirectToRoute('trick.index');
        }

        return $this->render('admin/tricks/new.html.twig', [
            #'trick' => $trick,
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
    public function edit(Trick $trick, Request $request, EventDispatcherInterface $event_dispatcher)
    {
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event_dispatcher->dispatch(AdminUploadTrickImageEvent::NAME, new AdminUploadTrickImageEvent($trick));

            $this->em->flush();
            $this->addFlash('success', 'Le trick a bien été modifié');
            return $this->redirectToRoute('trick.index');
        }

        return $this->render('admin/tricks/edit.html.twig', [
            'trick' => $trick,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/{id}", name="admin.tricks.delete", methods="DELETE")
     * @param Request $request
     * @param Trick $trick
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Trick $trick)
    {
        $form = $this->createDeleteForm($trick);
        $form->handleRequest($request);

        if ($trick) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($trick);
            $em->flush();
            $this->addFlash('success', 'Le trick a bien été supprimé');
        }

        return $this->redirectToRoute('trick.index');
    }

    /**
     * @param Trick $trick
     * @return mixed
     */
    private function createDeleteForm(Trick $trick)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin.tricks.delete', array('id' => $trick->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}