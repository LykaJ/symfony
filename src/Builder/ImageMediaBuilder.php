<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 2019-04-05
 * Time: 23:47
 */

namespace App\Builder;


use App\Dto\ImageMediaDTO;
use App\Entity\ImageMedia;
use App\Service\FileUploader;

class ImageMediaBuilder
{
    /**
     * @var FileUploader
     */
    private $fileUploader;

    private $mediaImages = [];

    /**
     * ImageBuilder constructor.
     *
     * @param FileUploader $fileUploader
     */
    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }


    public function create(array $mediaImagesDTO)
    {

        foreach ($mediaImagesDTO as $mediaImageDTO) {
            $this->mediaImages[] = $this->createMediaImage($mediaImageDTO);
        }

        return $this;
    }

    public function getMediaImages()
    {
        return $this->mediaImages;
    }

    public function createMediaImage(ImageMediaDTO $mediaImageDTO)
    {
        $filename = $this->fileUploader->upload($mediaImageDTO->file);

        $imageMedia = new ImageMedia();
        $imageMedia->setName($filename);

        return $imageMedia;
    }
}