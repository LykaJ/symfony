<?php
namespace App\Event;


use App\Entity\Trick;
use Symfony\Component\EventDispatcher\Event;

class AdminUploadTrickImageEvent extends Event

{
    const NAME = 'trick.image.upload';

    private $trick;

    public function __construct(Trick $trick)
    {
        $this->trick = $trick;
    }

    public function getTrick()
    {
       return $this->trick;
    }
}