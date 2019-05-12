<?php
/**
 * Created by PhpStorm.
 * User: Alicia
 * Date: 2019-04-14
 * Time: 16:22
 */

namespace App\Tests\Entity;


use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UserTest extends TestCase
{

    public function testUsername()
    {
        $user = new User();
        $user->setUsername('Jane');

        $this->assertSame('Jane', $user->getUsername());
    }

    public function testRealName()
    {
        $user = new User();
        $user->setRealName('Jane Doe');

        $this->assertSame('Jane Doe', $user->getRealName());
    }

    public function testEmail()
    {
        $user = new User();
        $user->setEmail('email@email.com');

        $this->assertSame('email@email.com', $user->getEmail());
    }

    public function testPassword()
    {
        $user = new User();
        $user->setPassword('Pass');

        $this->assertSame('Pass', $user->getPassword());
    }

    public function testSignUpDate()
    {
        $user = new User();
        $date = new \DateTime('2019-03-11 17:14:15');

        $user->setSignupDate($date);

        $this->assertSame($date, $user->getSignupDate());
    }

    public function testLastLogin()
    {
        $user = new User();
        $date = new \DateTime('2019-03-11 17:14:15');

        $user->setLastLogin($date);

        $this->assertSame($date, $user->getLastLogin());
    }

    /**
     * @throws \Exception
     */
    public function testUploadedPicture()
    {
        $user = new User();
        $path = 'public/uploads/media/89e2c035360bfff2ec28560288f02772.jpeg';
        $originalName = 'Toto.jpg';
        $file = new UploadedFile($path, $originalName);
        $user->setPictureUpload($file);

        $this->assertSame($file, $user->getPictureUpload());
    }

    /**
     * @throws \Exception
     */
    public function testPicture()
    {
        $user = new User();
        $file = 'public/uploads/media/89e2c035360bfff2ec28560288f02772.jpeg';
        $user->setPicture($file);

        $this->assertSame($file, $user->getPicture());
    }

    public function testToken()
    {
        $user = new User();
        $token = 'Token';
        $user->setResetToken($token);

        $this->assertSame($token, $user->getResetToken());
    }
}