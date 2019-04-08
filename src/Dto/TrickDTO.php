<?php
/**
 * Created by PhpStorm.
 * User: Alicia
 * Date: 2019-04-05
 * Time: 14:48
 */

namespace App\Dto;


use App\Entity\Category;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\Collection;


class TrickDTO
{
    public $title;
    public $content;
    public $category;
    public $uploadedImage;
    public $mediaVideos;
    public $mediaImages;


    public function __construct(
        string $title,
        string $content,
        UploadedFile $uploadedImage = null,
        Category $category = null,
        array $mediaVideos = null,
        array $mediaImages = null
)
    {
        $this->title = $title;
        $this->content = $content;
        $this->uploadedImage = $uploadedImage;
        $this->category = $category;
        $this->mediaVideos = $mediaVideos;
        $this->mediaImages = $mediaImages;
    }
}