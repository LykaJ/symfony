<?php
/**
 * Created by PhpStorm.
 * User: Alicia
 * Date: 2019-04-14
 * Time: 16:21
 */

namespace App\Tests\Entity;


use App\Entity\PasswordReset;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class PasswordResetTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testUser()
    {
        $passReset = new PasswordReset();
        $user = new User();
        $passReset->setUser($user);

        $this->assertSame($user, $passReset->getUser());
    }

    public function testToken()
    {
        $passReset = new PasswordReset();
        $passReset->setToken('token_test');

        $this->assertSame('token_test', $passReset->getToken());
    }

    /**
     * @throws \Exception
     */
    public function testExpiresAt()
    {
        $passReset = new PasswordReset();
        $date = new \DateTime('2019-03-11 17:14:15');
        $passReset->setExpiresAt($date);

        $this->assertSame($date, $passReset->getExpiresAt());
    }
}