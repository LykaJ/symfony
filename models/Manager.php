<?php

class Manager
{
  protected function dbConnect()
  {
    $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'admin', 'admin32');
    return $db;
  }
}
