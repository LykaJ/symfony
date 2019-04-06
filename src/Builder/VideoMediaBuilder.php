<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 2019-04-06
 * Time: 00:10
 */

namespace App\Builder;


use App\Dto\VideoMediaDTO;
use App\Entity\VideoMedia;

class VideoMediaBuilder
{
    private $mediaVideos = [];

    public function create(array $mediaVideosDTO)
    {
        foreach ($mediaVideosDTO as $mediaVideoDTO) {
            $this->mediaVideos[] = $this->createVideoMedia($mediaVideoDTO);
        }

        return $this;
    }

    public function getMediaVideos()
    {
        return $this->mediaVideos;
    }

    private function createVideoMedia(VideoMediaDTO $video_media_DTO)
    {
        $videoMedia = new VideoMedia();
        $videoMedia->setPath($video_media_DTO->url);

        return $videoMedia;
    }
}