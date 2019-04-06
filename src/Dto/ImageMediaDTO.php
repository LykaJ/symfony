<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 2019-04-05
 * Time: 23:54
 */

namespace App\Dto;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageMediaDTO
{
    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * ImageDTO constructor.
     * @param UploadedFile|null $file
     */
    public function __construct(
        UploadedFile $file = null
    )
    {
        $this->file = $file;
    }
}