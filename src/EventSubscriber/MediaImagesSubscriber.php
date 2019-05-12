<?php

namespace App\EventSubscriber;

use App\Event\MediaImagesUploadEvent;
use App\Service\MediaImagesUploader;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
            ],
        ];
    }

    public function uploadImageMedia(MediaImagesUploadEvent $event)
    {
        $trick = $event->getTrick();

        foreach ($trick->getMediaImages() as $imageMedia) {
            if (($imageMedia->getName() === null && $imageMedia->getFile() instanceof UploadedFile)) {
                $imageMedia->setName($this->uploader->upload($imageMedia->getFile()));
                $imageMedia->setTrick($trick);
            }
        }
    }

}