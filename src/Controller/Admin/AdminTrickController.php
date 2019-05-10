<?php

namespace App\Controller\Admin;

use App\Entity\Trick;
use App\Entity\User;
use App\Event\AdminUploadTrickImageEvent;
use App\Event\MediaImagesUploadEvent;
use App\Form\TrickType;
use App\Repository\TrickRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminTrickController extends AbstractController
{
    /**
     * @var TrickRepository
     */
    private $repository;
    private $objectManager;

    public function __construct(TrickRepository $repository, ObjectManager $objectManager)
    {
        $this->repository = $repository;
        $this->objectManager = $objectManager;
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
     * @Route("/tricks/new", name="admin.tricks.new")
     * @param Request $request
     * @param EventDispatcherInterface $eventDispatcher
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function create(Request $request, EventDispatcherInterface $eventDispatcher)
    {
        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $mediaImages = $form->get('mediaImages')->getData();


            if (!is_object($mediaImages) && empty($mediaImages)) {
                $this->addFlash('error', 'Tous les champs ne sont pas remplis');
            }

            $eventDispatcher->dispatch(AdminUploadTrickImageEvent::NAME, new AdminUploadTrickImageEvent($trick));
            $eventDispatcher->dispatch(MediaImagesUploadEvent::IMAGE_UPLOAD, new MediaImagesUploadEvent($trick));

            $currentUser = $this->get('security.token_storage')->getToken()->getUser();
            if ($currentUser instanceof User) {
                $trick->setAuthor($currentUser);
            }

            if ($form->get('mediaVideos') != null) {
                foreach ($form->get('mediaVideos') as $k => $form_video) {
                    $uploadedVideo = $form_video->get('path')->getData();
                    $mediaVideo = $trick->getMediaVideos()[$k];
                    $mediaVideo->setPath($uploadedVideo);
                    $mediaVideo->setTrick($trick);
                }
            }

            $this->objectManager->persist($trick);
            $this->objectManager->flush();
            $this->addFlash('success', 'Le trick a bien été créé');
            if (!$form->isSubmitted() && !$form->isValid()) {
                $this->addFlash('error', 'Le trick n\'a pas pu être créé');
            }
            return $this->redirectToRoute('trick.index');
        }
        return $this->render('admin/tricks/new.html.twig', [
            'trick' => $trick,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/tricks/{id}/edit", name="admin.tricks.edit", methods="GET|POST")
     * @param Trick $trick
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function edit(Trick $trick, Request $request, EventDispatcherInterface $eventDispatcher)
    {

        $form = $this->createForm(TrickType::class, $trick);
        $form->remove('imageUpload');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($trick->getImage() === null)
            {
                $eventDispatcher->dispatch(AdminUploadTrickImageEvent::NAME, new AdminUploadTrickImageEvent($trick));
            } else {
                $trick->getImage();
            }

            $eventDispatcher->dispatch(MediaImagesUploadEvent::IMAGE_UPLOAD, new MediaImagesUploadEvent($trick));

            if ($form->get('mediaVideos') != null) {
                foreach ($form->get('mediaVideos') as $k => $form_video) {
                    $uploadedVideo = $form_video->get('path')->getData();
                    $mediaVideo = $trick->getMediaVideos()[$k];
                    $mediaVideo->setPath($uploadedVideo);
                    $mediaVideo->setTrick($trick);
                }
            }
            $this->objectManager->flush();
            $this->addFlash('success', 'Le trick a bien été modifié');
            return $this->redirectToRoute('trick.index');
        }
        return $this->render('admin/tricks/edit.html.twig', [
            'trick' => $trick,
            'form' => $form->createView()]);
    }


    /**
     * @Route("/tricks/{id}", name="admin.tricks.delete", methods="DELETE")
     * @param Request $request
     * @param Trick $trick
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Trick $trick)
    {
        $form = $this->createDeleteForm($trick);
        $form->handleRequest($request);
        if ($trick) {
            $objectManager = $this->getDoctrine()->getManager();
            $objectManager->remove($trick);
            $objectManager->flush();
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