<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;
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

        $rotateCategory = new Category();
        $rotateCategory->setName('rotate');
        $manager->persist($rotateCategory);
        $manager->flush();

        $commentedTrick = new Trick();
        $commentedTrick->setTitle('Mute');
        $commentedTrick->setContent('Saisie de la carre frontside de la planche entre les deux pieds avec la main avant');
        $commentedTrick->setCategory($category);
        $commentedTrick->setCreationDate(new \DateTime('2019-03-11 17:14:36'));
        $commentedTrick->setAuthor($user);
        $commentedTrick->setImage('trick_fixture.jpeg');
        $manager->persist($commentedTrick);
        $manager->flush();

        $trick = new Trick();
        $trick->setTitle('Sad');
        $trick->setContent('Saisie de la carre backside de la planche, entre les deux pieds, avec la main avant');
        $trick->setCategory($category);
        $trick->setCreationDate(new \DateTime('now'));
        $trick->setAuthor($user);
        $trick->setImage('trick_fixture.jpeg');
        $manager->persist($trick);
        $manager->flush();

        $trick = new Trick();
        $trick->setTitle('Indy');
        $trick->setContent('Saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière');
        $trick->setCategory($category);
        $trick->setCreationDate(new \DateTime('now'));
        $trick->setAuthor($user);
        $trick->setImage('trick_fixture.jpeg');
        $manager->persist($trick);
        $manager->flush();

        $trick = new Trick();
        $trick->setTitle('Stalefish');
        $trick->setContent('Saisie de la carre backside de la planche entre les deux pieds avec la main arrière');
        $trick->setCategory($category);
        $trick->setCreationDate(new \DateTime('now'));
        $trick->setAuthor($user);
        $trick->setImage('trick_fixture.jpeg');
        $manager->persist($trick);
        $manager->flush();

        $trick = new Trick();
        $trick->setTitle('Tail grab');
        $trick->setContent('Saisie de la partie arrière de la planche, avec la main arrière');
        $trick->setCategory($category);
        $trick->setCreationDate(new \DateTime('now'));
        $trick->setAuthor($user);
        $trick->setImage('trick_fixture.jpeg');
        $manager->persist($trick);
        $manager->flush();

        $trick = new Trick();
        $trick->setTitle('360');
        $trick->setContent('Trois six pour un tour complet ;');
        $trick->setCategory($rotateCategory);
        $trick->setCreationDate(new \DateTime('now'));
        $trick->setAuthor($user);
        $trick->setImage('trick_fixture.jpeg');
        $manager->persist($trick);
        $manager->flush();

        $trick = new Trick();
        $trick->setTitle('Nose grab');
        $trick->setContent('Saisie de la partie avant de la planche, avec la main avant');
        $trick->setCategory($category);
        $trick->setCreationDate(new \DateTime('now'));
        $trick->setAuthor($user);
        $trick->setImage('trick_fixture.jpeg');
        $manager->persist($trick);
        $manager->flush();

        $trick = new Trick();
        $trick->setTitle('Japan');
        $trick->setContent('Saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside.');
        $trick->setCategory($category);
        $trick->setCreationDate(new \DateTime('now'));
        $trick->setAuthor($user);
        $trick->setImage('trick_fixture.jpeg');
        $manager->persist($trick);
        $manager->flush();

        $trick = new Trick();
        $trick->setTitle('Seat belt');
        $trick->setContent('Saisie du carre frontside à l\'arrière avec la main avant ');
        $trick->setCategory($category);
        $trick->setCreationDate(new \DateTime('now'));
        $trick->setAuthor($user);
        $trick->setImage('trick_fixture.jpeg');
        $manager->persist($trick);
        $manager->flush();

        $trick = new Trick();
        $trick->setTitle('Truck driver');
        $trick->setContent('Saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture)');
        $trick->setCategory($category);
        $trick->setCreationDate(new \DateTime('now'));
        $trick->setAuthor($user);
        $trick->setImage('trick_fixture.jpeg');
        $manager->persist($trick);
        $manager->flush();

        $trick = new Trick();
        $trick->setTitle('180');
        $trick->setContent('Désigne un demi-tour, soit 180 degrés d\'angle');
        $trick->setCategory($rotateCategory);
        $trick->setCreationDate(new \DateTime('now'));
        $trick->setAuthor($user);
        $trick->setImage('trick_fixture.jpeg');
        $manager->persist($trick);
        $manager->flush();

        $comment = new Comment();
        $comment->setTrick($commentedTrick);
        $comment->setAuthor($user);
        $comment->setContent('I love this website');
        $comment->setCreationDate(new \DateTime('now'));
        $manager->persist($comment);
        $manager->flush();
    }
}
