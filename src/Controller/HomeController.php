<?php
/**
 * Created by PhpStorm.
 * User: Alicia
 * Date: 2019-02-22
 * Time: 16:27
 */

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @param TrickRepository $repository
     * @var Environment
     * @return Response
     */

    public function index(TrickRepository $repository): Response
    {
        $tricks = $repository->findLatest();
        return $this->render('pages/home.html.twig', [
            'tricks' => $tricks
        ]);
    }
}