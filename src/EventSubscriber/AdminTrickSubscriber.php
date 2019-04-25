<?php
namespace App\EventSubscriber;

use App\Event\AdminUploadTrickImageEvent;
use App\Service\FileUploader;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdminTrickSubscriber implements EventSubscriberInterface
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            AdminUploadTrickImageEvent::NAME => [
                ['upload', 10]
            ],
        ];
    }

    public function upload(AdminUploadTrickImageEvent $event)
    {
       $trick = $event->getTrick();
       $trick->setImage($this->uploader->upload($trick->getImageUpload()));
    }
}