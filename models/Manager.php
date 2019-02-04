<?php

namespace Blog\models;

use \Blog\Database;

require_once('core/database/Database.php');

class Manager
{
    protected $db;

    public function __construct() {
        $this->db = Database::get();
    }
}
