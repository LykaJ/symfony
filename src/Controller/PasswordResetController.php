<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class PasswordResetController extends AbstractController
{
    /**
     * @Route("/forgotten_password", name="forgotten_password")
     */
    public function forgottenPassword(Request $request, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator): Response
    {
        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');

            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);
            /* @var $user User */

            if ($user === null) {
                $this->addFlash('danger', 'Une erreur s\'est produite');
                return $this->redirectToRoute('trick.index');
            }

            $token = $tokenGenerator->generateToken();

            try {
                $user->setResetToken($token);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
                return $this->redirectToRoute('trick.index');
            }

            $url = $this->generateUrl('reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            $message = (new \Swift_Message('Mot de passe oublié'))
                ->setFrom(['webdesigner.form@gmail.com' => 'SnowTricks']) // recheck comments faire
                ->setTo($user->getEmail())
                ->setBody(
                    "Cliquez sur ce lien pour réinitialiser votre mot de passe : " . $url,
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('success', 'Le mail a bien été envoyé');

            return $this->redirectToRoute('trick.index');
        }

        return $this->render('security/password_forgotten.html.twig');
    }

    /**
     * @Route("/reset_password/{token}", name="reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository, ObjectManager $entityManager)
    {
        $user_token = $userRepository->findOneBy(
            array('token' => $request->get('token'))
        );

        if (!$user_token) {

            $this->addFlash(
                'error',
                'Accès refusé'
            );
            return $this->redirectToRoute('trick.index');
        }

        if ($request->isMethod('POST')) {

            if ($request->get('password') === $request->get('confirm_password'))
            {
                $user_token->setResetToken(null);
                $user_token->setPassword($passwordEncoder->encodePassword($user_token, $request->request->get('password')));
                $entityManager->flush();

                $this->addFlash('success', 'Le mot de passe a été réinitialisé');
                return $this->redirectToRoute('login');
            } else {
                $this->addFlash('error', 'Les mots de passe ne sont pas identiques');
                return $this->render('security/password_reset.html.twig', ['token' => $token]);
            }


        } else {
            return $this->render('security/password_reset.html.twig', ['token' => $token]);
        }
    }

}
