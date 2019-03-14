<?php
namespace App\EventListener;

use App\Entity\Trick;
use App\Service\FileUploader;

class UploadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @throws \Exception
     */
    public function upload()
    {
        $trick = new Trick();
        $trick->uploader->upload($trick->getImage());
    }

}