<?php
namespace Blog;

require_once('core/database/AccessDb.php');

class Database
{
    private static $PDOInstance = null;


    public static function get()
    {
        if (is_null(self::$PDOInstance)) {
            self::$PDOInstance = new \PDO(
              'mysql:dbname='.AccessDb::$dbName.';host='.AccessDb::$host,
              AccessDb::$user,
              AccessDb::$pass
          );

            self::$PDOInstance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return self::$PDOInstance;
    }

    private function __construct()
    {
    }
}
