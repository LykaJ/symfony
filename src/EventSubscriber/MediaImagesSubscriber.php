<?php

namespace App\EventSubscriber;

use App\Event\MediaImagesUploadEvent;
use App\Service\MediaImagesUploader;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MediaImagesSubscriber implements EventSubscriberInterface
{
    private $uploader;

    public function __construct(MediaImagesUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            MediaImagesUploadEvent::IMAGE_UPLOAD => [
                ['uploadImageMedia', 10],
                ['remove', 20],
            ],
        ];
    }

    public function uploadImageMedia(MediaImagesUploadEvent $event)
    {
        $trick = $event->getTrick();

        foreach ($trick->getMediaImages() as $image_media) {
            if (($image_media->getName() === null)) {
                $image_media->setName($this->uploader->upload($image_media->getFile()));
            }

            $image_media->setTrick($trick);
        }
    }

    public function remove(MediaImagesUploadEvent $event)
    {
        $trick = $event->getTrick();

        foreach ($trick->getMediaImages() as $image_media)
        {
            $file = $image_media->getName();
        }

        if(isset($file))
        {
            $file_path = $this->uploader->getMediaDirectory().'/'.$file;
            if(file_exists($file_path)) unlink($file_path);
        }

    }
}