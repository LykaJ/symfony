<?php

namespace App\Dto;

class UploadedImageDTO
{
    public $file;

    public function __construct(\SplFileInfo $file = null)
    {
        $this->file = $file;
    }
}