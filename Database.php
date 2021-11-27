<?php

date_default_timezone_set('Europe/Brussels');

class Database
{
    private $_connection;
    private static $_instance = null;
    
    private static $DB_DSN = 'mysql:host=localhost;dbname=u870391923_MyDB';
    private static $DB_USER = 'u870391923_root';
    private static $DB_PASS = 'o8jtuHhZPmLXiVUZoj';

    private function __construct()
    {
        try
        {
            $options =
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            $this->_connection = new PDO(self::$DB_DSN, self::$DB_USER, self::$DB_PASS, $options);
        }
        catch(PDOException $e)
        {
            die("ERREUR : " . $e->getMessage());
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

    public function request($sql, $fields)
    {
        try
        {
            $req = $this->getConnection()->prepare($sql);
            $req->execute($fields);

            // if($req)
            //     echo "<script type= 'text/javascript'>alert('Requête exécutée avec succès.');</script>";

            return $req->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            // echo "<script type= 'text/javascript'>alert('Requête non exécutée.');</script>";

            die("ERREUR : " . $e->getMessage());
        }
    }

    public function display()
    {
        $sql = 'SELECT * FROM table_dht ORDER BY id_dht DESC LIMIT 5;';

        try
        {
            return $req = $this->getConnection()->query($sql)->fetchall(PDO::FETCH_ASSOC);
        }
        catch(PDOException $pe)
        {
            echo 'ERREUR : '.$pe->getMessage();
        }
    }
}