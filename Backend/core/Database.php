<?php

namespace App\core;

use PDO;
use PDOException;

class Database
{

    private static $con = null;
    private static $stmt;



    public static function connect()
    {
        if (is_null(self::$con)) {
            try {
                $OPTIONS = array(
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                );
                self::$con = new PDO($_ENV["DSN"], $_ENV["USERNAME"], $_ENV["PASSWORD"], $OPTIONS);
            } catch (PDOException $e) {
                return  $e->getMessage();
            }
        }
    }

    public static function query($query)
    {
        Database::connect();
        self::$stmt = self::$con->prepare($query);
        return new self;
    }

    public  function execute()
    {
        return self::$stmt->execute();
    }
    public  function getResult()
    {
        self::$stmt->execute();
        return self::$stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getSingleResult()
    {
        self::$stmt->execute();
        return self::$stmt->fetch(PDO::FETCH_OBJ);
    }
    public function getRowCount()
    {
        self::$stmt->execute();
        return self::$stmt->rowCount();
    }
    public static function lastID()
    {
        return self::$con->lastInsertId();
    }
}
