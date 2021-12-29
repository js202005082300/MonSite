<?php

$sql = 'SELECT * FROM table_users;';
$req = Database::getInstance()->request($sql, NULL, true);
foreach($req as $row):
    if($row['user_online'] == 1)
    {
        echo '<img src="icons/msn-07.png" width="20" alt="Photos Msn Icon" />';
        echo htmlspecialchars($row['user_name']).'</br>';
    }
    else
    {
        echo '<img src="icons/msn-13.png" width="20" alt="Photos Msn Icon" />';
        echo htmlspecialchars($row['user_name']).'</br>';
    }
endforeach;

?>