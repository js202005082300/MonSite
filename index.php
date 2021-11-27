<?php

echo '<pre>';
print_r($_POST);
echo '</pre>';

$dsn = 'mysql:host=localhost;dbname=u870391923_MyDB';
$username = 'u870391923_root';
$password = 'o8jtuHhZPmLXiVUZoj';
try{$conn = new PDO($dsn, $username, $password);}
catch(PDOException $pe){echo $pe->getMessage();}
if($conn){echo "Connexion MySQL établie !\r\n";}


?>