<?php
/**
 * Created by PhpStorm.
 * User: Alicia
 * Date: 2019-04-14
 * Time: 16:21
 */

namespace App\Tests\Entity;


use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TrickTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testTitle()
    {
        $trick = new Trick();
        $trick->setTitle('Title');

        $this->assertSame('Title', $trick->getTitle());
    }

    /**
     * @throws \Exception
     */
    public function testContent()
    {
        $trick = new Trick();
        $trick->setContent('Content');

        $this->assertSame('Content', $trick->getContent());
    }

    /**
     * @throws \Exception
     */
    public function testCategory()
    {
        $trick = new Trick();
        $category = new Category();
        $trick->setCategory($category);

        $this->assertSame($category, $trick->getCategory());
    }

    /**
     * @throws \Exception
     */
    public function testCreationDate()
    {
        $trick = new Trick();
        $date = new \DateTime('2019-03-11 17:14:15');

        $trick->setCreationDate($date);

        $this->assertSame($date, $trick->getCreationDate());
    }

    /**
     * @throws \Exception
     */
    public function testEditionDate()
    {
        $trick = new Trick();
        $date = new \DateTime('2019-03-11 17:14:15');

        $trick->setEditionDate($date);

        $this->assertSame($date, $trick->getEditionDate());
    }

    /**
     * @throws \Exception
     */
    public function testUploadedImage()
    {
        $trick = new Trick();
        $path = 'public/uploads/media/89e2c035360bfff2ec28560288f02772.jpeg';
        $originalName = 'Toto.jpg';
        $file = new UploadedFile($path, $originalName);
        $trick->setImageUpload($file);

        $this->assertSame($file, $trick->getImageUpload());
    }

    /**
     * @throws \Exception
     */
    public function testImage()
    {
        $trick = new Trick();
        $file = 'public/uploads/media/3fca48f2b09cd4d8290d23842792d3aa.jpeg';
        $trick->setImage($file);

        $this->assertSame($file, $trick->getImage());
    }

    /**
     * @throws \Exception
     */
    public function testAuthor()
    {
        $trick = new Trick();
        $author = new User();
        $trick->setAuthor($author);

        $this->assertSame($author, $trick->getAuthor());
    }
}