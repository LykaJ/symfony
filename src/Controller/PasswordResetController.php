<?php

namespace App\Controller;

use App\Entity\PasswordReset;
use App\Entity\User;
use App\Form\PasswordResetType;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordResetController extends AbstractController
{
    /**
     * @Route("/password/reset/", name="password_reset")
     */
    public function passwordReset(Request $request, ObjectManager $em, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $password_reset = new PasswordReset();
        $form = $this->createForm(PasswordResetType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $userId = $this->get('security.token_storage')->getToken()->getUser();
            $password_reset->setUser($userId)
                            ->setExpiresAt(new \DateTime('+1 day'));
            $hash = $encoder->encodePassword($user, $user->getNewPassword());
            $user->setPassword($hash);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('login');
        }
        return $this->render('security/password_reset.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
