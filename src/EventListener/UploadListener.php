<?php
namespace App\EventListener;

use App\Entity\Trick;
use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;


class UploadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param LifecycleEventArgs $args
     * @return bool
     * @throws \Exception
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if(!$entity instanceof Trick)
        {
            return false;
        }

        /**
         * @var $entity Trick
         */

        $file = $entity->getImage();

        if ($file instanceof UploadedFile) {

            $fileName = $this->uploader->upload($file);
            $entity->setImage($fileName);

        } elseif ($file instanceof File) {

            $entity->setImage($file->getFilename());
        }
    }
}