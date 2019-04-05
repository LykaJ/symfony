<?php
/**
 * Created by PhpStorm.
 * User: Alicia
 * Date: 2019-04-05
 * Time: 14:59
 */

namespace App\Builder;


use App\Dto\TrickDTO;
use App\Entity\Trick;

class TrickBuilder
{
    private $trick;

    public function build(TrickDTO $trickDTO)
    {
        $this->trick = new Trick(
            $trickDTO->title,
            $trickDTO->content,
            $trickDTO->category,
            $trickDTO->creation_date,
            $trickDTO->edition_date,
            $trickDTO->author,
            $trickDTO->mediaVideos,
            $trickDTO->uploadedImage,
            $trickDTO->mediaImages
        );

        return $this;
    }

    public function getTrick()
    {
        return $this->trick;
    }
}