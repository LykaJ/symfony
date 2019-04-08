<?php
namespace App\Service;

use App\Entity\Trick;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaImagesUploader
{
    private $mediaDirectory;

    public function __construct(string $mediaDirectory)
    {
        $this->mediaDirectory = $mediaDirectory;
    }

    public function upload(?UploadedFile $file)
    {
        if ($file !== null)
        {
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            try {
                $file->move($this->getMediaDirectory(), $fileName);
            } catch (FileException $e) {
                $e->getMessage();
            }

            return $fileName;
        }

    }

    public function getTrick(Trick $trick)
    {
        $this->trick = $trick;

        return $trick;
    }

    public function getMediaDirectory()
    {
        return $this->mediaDirectory;
    }

    /*  public function removeUploadedImage(UploadedFile $file): self
      {
          $file_path = $this->getTargetDirectory().'/'.$file;
          if(file_exists($file_path)) unlink($file_path);
      } */
}