<?php

namespace App\Event;


use App\Entity\Trick;
use Symfony\Component\EventDispatcher\Event;

class MediaImagesUploadEvent extends Event
{
    const IMAGE_UPLOAD = 'trick.media.upload';

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