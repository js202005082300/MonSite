<?php

function user_online($username, $state) : void
{
    $sql = 'UPDATE table_users SET user_online = :state WHERE user_name = :name';
    $fields = ['name' => $username, 'state' => $state];
    $req = Database::getInstance()->request($sql, $fields);
}

function user_lastConnexion($username) : void
{
    $sql = 'UPDATE table_users SET user_lastConnexion=now() WHERE user_name = :name';
    $fields = ['name' => $username];
    $req = Database::getInstance()->request($sql, $fields);
}