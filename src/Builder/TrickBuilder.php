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
    private $imageBuilder;
    private $videoBuilder;

    public function __construct(ImageMediaBuilder $imageBuilder, VideoMediaBuilder $videoBuilder)
    {
        $this->imageBuilder = $imageBuilder;
        $this->videoBuilder = $videoBuilder;
    }

    public function build(TrickDTO $trickDTO)
    {
        $this->trick = new Trick(
            $trickDTO->title,
            $trickDTO->content,
            $trickDTO->category,
            '',
            $this->videoBuilder->create($trickDTO->mediaVideos)->getMediaVideos(),
            $this->imageBuilder->create($trickDTO->mediaImages)->getMediaImages()
        );

        return $this;
    }

    public function getTrick()
    {
        return $this->trick;
    }
}