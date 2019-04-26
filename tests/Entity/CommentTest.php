<?php
/**
 * Created by PhpStorm.
 * User: Alicia
 * Date: 2019-04-14
 * Time: 15:57
 */

namespace App\Tests\Entity;


use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    public function testContent()
    {
        $comment = new Comment();
        $comment->setContent('Hello World');

        $this->assertSame('Hello World', $comment->getContent());
    }

    /**
     * @throws \Exception
     */
    public function testCreationDate()
    {
        $comment = new Comment();
        $date = new \DateTime('2019-03-11 17:14:15');
        $comment->setCreationDate($date);

        $this->assertSame($date, $comment->getCreationDate());
    }

    /**
     * @throws \Exception
     */
    public function testTrick()
    {
        $comment = new Comment();
        $trick = new Trick();
        $comment->setTrick($trick);

        $this->assertSame($trick, $comment->getTrick());
    }

    /**
     * @throws \Exception
     */
    public function testUser()
    {
        $comment = new Comment();
        $user = new User();

        $comment->setAuthor($user);

        $this->assertSame($user, $comment->getAuthor());
    }
}