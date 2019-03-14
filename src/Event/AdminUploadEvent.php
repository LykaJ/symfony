<?php
namespace App\Event;



use Symfony\Component\EventDispatcher\EventDispatcher;

class AdminUploadEvent extends EventDispatcher
{
    const NAME = 'create.trick';
}