<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $comment = new Comment();
        $comment->setTrick('18');
        $comment->setAuthor('10');
        $comment->setContent('I love this website');
        $comment->setCreationDate(new \DateTime('now'));
        $manager->persist($comment);
        $manager->flush();
    }
}
