<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 2019-04-06
 * Time: 00:08
 */

namespace App\Dto;


class VideoMediaDTO
{
    /**
     * @var string
     */
    public $url;

    public function __construct(
        string $url = null
    )
    {
        $this->url = $url;
    }
}