<?php

date_default_timezone_set('Europe/Brussels');

class Database
{
    private $_connection = null;
    private static $_instance = null;
    
    private static $DB_DSN = 'mysql:host=localhost;dbname=u870391923_MyDB';
    private static $DB_USER = 'u870391923_root';
    private static $DB_PASS = 'o8jtuHhZPmLXiVUZoj';

    private static $DB_LOCAL_DSN = 'mysql:host=localhost;dbname=MyDB';
    private static $DB_LOCAL_USER = 'root';
    private static $DB_LOCAL_PASS = '';

    private function __construct()
    {
        try
        {
            $options =
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            if(isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == "localhost")
                $this->_connection = new PDO(self::$DB_LOCAL_DSN, self::$DB_LOCAL_USER, self::$DB_LOCAL_PASS, $options);
            else
                $this->_connection = new PDO(self::$DB_DSN, self::$DB_USER, self::$DB_PASS, $options);
        }
        catch(PDOException $e)
        {
            echo "ERREUR : " . $e->getMessage();
            return 0;
        }
    }

    public static function getInstance()
    {
        if(is_null(self::$_instance))
            self::$_instance = new Database();

        return self::$_instance;
    }

    public function getConnection()
    {
        return $this->_connection;
    }

    public function freeConnection()
    {
        return $this->_connection = NULL;
    }
    
    public function request($sql, $fields = NULL, $fetchall = false)
    {
        try{
            $req = $this->getConnection()->prepare($sql);
            $req->execute($fields);

            if(!$fetchall){
                return $req->fetch(PDO::FETCH_ASSOC);
            }
            else{
                return $req->fetchall(PDO::FETCH_ASSOC);
            }
        }
        catch(PDOException $e){
            echo "ERREUR : " . $e->getMessage();
            return 1;
        }
    }
}