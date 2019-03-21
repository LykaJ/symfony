<?php
namespace App\EventSubscriber;

use App\Event\UploadUserPictureEvent;
use App\Service\FileUploader;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UploadUserSubscriber implements EventSubscriberInterface
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
            UploadUserPictureEvent::NAME => [
                ['upload', 10],
                ['remove', 20],
            ],
        ];
    }

    public function upload(UploadUserPictureEvent $event)
    {
        $user = $event->getUser();
        $user->setPicture($this->uploader->upload($user->getPictureUpload()));

    }

    public function remove(UploadUserPictureEvent $event)
    {
        $trick = $event->getUser();
        $file = $trick->getPicture();

        if(isset($file))
        {
            $file_path = $this->uploader->getTargetDirectory().'/'.$file;
            if(file_exists($file_path)) unlink($file_path);
        }

    }
}