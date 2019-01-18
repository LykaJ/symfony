<?php

class Manager
{

  protected function dbConnect()
  {
    $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', '', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $db;
  }
}
