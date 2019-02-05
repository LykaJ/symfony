<?php
namespace Blog;

class Database
{
    private static $PDOInstance = null;

    const DEFAULT_SQL_USER = 'root';
    const DEFAULT_SQL_HOST = 'localhost';
    const DEFAULT_SQL_PASS = 'admin32';
    const DEFAULT_SQL_DTB = 'blog';

    public static function get()
    {
        if (is_null(self::$PDOInstance)) {
            self::$PDOInstance = new \PDO(
              'mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST,
              self::DEFAULT_SQL_USER,
              self::DEFAULT_SQL_PASS
          );
            self::$PDOInstance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return self::$PDOInstance;
    }

    private function __construct()
    {
    }
}
