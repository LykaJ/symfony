<?php
/**
 * Created by PhpStorm.
 * User: Alicia
 * Date: 2019-04-14
 * Time: 16:21
 */

namespace App\Tests\Entity;


use App\Entity\ImageMedia;
use App\Entity\Trick;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageMediaTest extends TestCase
{
    public function testName()
    {
        $imageMedia = new ImageMedia();
        $imageMedia->setName('Image name');

        $this->assertSame('Image name', $imageMedia->getName());
    }

    public function testFile()
    {
        $imageMedia = new ImageMedia();
        $path = 'public/uploads/media/3fca48f2b09cd4d8290d23842792d3aa.jpeg';
        $originalName = 'Toto.jpg';
        $file = new UploadedFile($path, $originalName);
        $imageMedia->setFile($file);

        $this->assertSame($file, $imageMedia->getFile());
    }

    /**
     * @throws \Exception
     */
    public function testTrick()
    {
        $imageMedia = new ImageMedia();
        $trick = new Trick();
        $imageMedia->setTrick($trick);

        $this->assertEquals($trick, $imageMedia->getTrick());
    }
}