<?php
/**
 * Created by PhpStorm.
 * User: Alicia
 * Date: 2019-04-14
 * Time: 16:22
 */

namespace App\Tests\Entity;


use App\Entity\Trick;
use App\Entity\VideoMedia;
use PHPUnit\Framework\TestCase;

class VideoMediaTest extends TestCase
{

    public function testPath()
    {
        $videoMedia = new VideoMedia();
        $path = 'path-to-video';
        $videoMedia->setPath($path);

        $this->assertSame($path, $videoMedia->getPath());
    }

    public function testTrick()
    {
        $videoMedia = new VideoMedia();
        $trick = new Trick();
        $videoMedia->setTrick($trick);

        $this->assertSame($trick, $videoMedia->getTrick());
    }
}