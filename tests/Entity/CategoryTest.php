<?php

namespace App\Tests\Entity;


use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testName()
    {
        $category = new Category();
        $category->setName('Toto');

        $this->assertSame('Toto', $category->getName());
    }
}