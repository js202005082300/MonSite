<?php

$dsn = 'mysql:host=localhost;dbname=u870391923_MyDB';
$username = 'u870391923_root';
$password = 'o8jtuHhZPmLXiVUZoj';
try{$conn = new PDO($dsn, $username, $password);}
catch(PDOException $pe){echo $pe->getMessage();}
if($conn){echo "Connexion MySQL établie !\r\n";}
$response=array();

if(isset($_POST['success']) && !empty($_POST['success']))
    if(isset($_POST['temperature']) && !empty($_POST['temperature']))
        if(isset($_POST['humidity']) && !empty($_POST['humidity']))
        {
            $temperature = $_POST["temperature"];
            $humidity = $_POST["humidity"];
            $success = $_POST["success"];
            //return;
            $sql="INSERT INTO table_dht(dht_success, dht_temperature, dht_humidity)
            VALUES ('$success', '$temperature', '$humidity')";

            try{$conn->query($sql);echo "Donnée(s) stockée(s)\r\n";}
            catch(Exception $pe){echo "Donnée(s) non stockée(s)\r\n";}
        }

$conn=null;echo "Connexion MySQL fermée !\r\n";
echo "------------------- Fin programme ! ------------------- \r\n\r\n";
?>