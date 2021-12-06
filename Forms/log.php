<?php
require 'Database/Database.php';
require 'util.php';

init_php_session();

$attempt_failed = 0;

if(isset($_GET['action']) && !empty($_GET['action'] && $_GET['action'] == "logout"))
{
    clean_php_session();
    header('Location: index.php');
}

if(isset($_POST['valid_connection']))
    if(isset($_POST['form_username']) && !empty($_POST['form_username']) && isset($_POST['form_password']) && !empty($_POST['form_password']))
    {
        $username = $_POST['form_username'];
        $password = $_POST['form_password'];

        $sql = 'SELECT * FROM table_users WHERE user_name = :name';
        $fields = ['name' => $username];
        $req = Database::getInstance()->request($sql, $fields);

        if($req && password_verify($password, $req['user_password']))
        {
            init_php_session();

            $_SESSION['username'] = $username;
            $_SESSION['rank'] = $req['user_admin'];
            
            $sql = 'UPDATE table_users SET user_lastConnexion=now() WHERE user_name = :name';
            $fields = ['name' => $username];
            $req = Database::getInstance()->request($sql, $fields);

            $attempt_failed = 0;
        }
        else
        {
            $attempt_failed = 1;
        }
    }
