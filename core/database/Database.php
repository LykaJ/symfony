<?php
namespace Blog;

require_once('core/database/AccessDb.php');

class Database
{
    private static $PDOInstance = null;

    const DEFAULT_SQL_USER = 'root';
   // const DEFAULT_SQL_HOST = 'localhost';
    const DEFAULT_SQL_PASS = 'admin32';
    const DEFAULT_SQL_DTB = 'blog';



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
