<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setRealName('Admin');
        $user->setPassword($this->encoder->encodePassword($user, 'admin'));
        $user->setEmail('admin@email.com');
        $user->setSignupDate(new \DateTime('now'));
        $user->setLastLogin(new \DateTime('now'));
        $manager->persist($user);
        $manager->flush();

        $category = new Category();
        $category->setName('grab');
        $manager->persist($category);
        $manager->flush();

        $trick = new Trick();
        $trick->setTitle('Mute');
        $trick->setContent('Saisie de la carre frontside de la planche entre les deux pieds avec la main avant');
        $trick->setCategory($category);
        $trick->setCreationDate(new \DateTime('2019-03-11 17:14:36'));
        $trick->setAuthor($user);
        $trick->setImage('public/images/trick_fixture.jpeg');
        $manager->persist($trick);
        $manager->flush();

        $comment = new Comment();
        $comment->setTrick($trick);
        $comment->setAuthor($user);
        $comment->setContent('I love this website');
        $comment->setCreationDate(new \DateTime('now'));
        $manager->persist($comment);
        $manager->flush();
    }
}
