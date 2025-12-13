<?php
// config/Database.php

class Database
{
    private static $instance = null;

    private function __construct() { }  // không cho new
    private function __clone() { }      // không cho clone

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $dsn = "mysql:host=localhost;dbname=onlinecourse;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            self::$instance = new PDO($dsn, "root", "", $options);
        }
        return self::$instance;
    }
}