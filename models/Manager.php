<?php
//namespace Blog;
require_once('core/database/database.php');

class Manager
{
    protected $db;

<<<<<<< HEAD
  protected function dbConnect()
  {
    $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', '', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $db;
  }
=======
    public function __construct() {
        $this->db = Database::get();
    }
>>>>>>> views
}
