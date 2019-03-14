<?php
namespace App\EventSubscriber;

use App\Entity\Trick;
use App\Event\AdminUploadEvent;
use App\Service\FileUploader;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UploadSubscriber implements EventSubscriberInterface
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
            AdminUploadEvent::UPLOAD => [
                ['upload', 10]
            ],
        ];
    }

    public function upload(AdminUploadEvent $event)
    {
       $trick = $event->getTrick();
       $this->uploader->upload($trick->getImage());
    }
}