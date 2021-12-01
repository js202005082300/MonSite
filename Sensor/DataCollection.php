<?php
require '../Database/Database.php';

if(isset($_POST) && !empty($_POST))
{    
    $fields = [
        'sensorName' => $_POST['sensorName'], 
        'humidity' => $_POST['humidity'], 
        'tempCelsus' => $_POST['tempCelsus'], 
        'tempFahrenheit' => $_POST['tempFahrenheit'], 
        'heatIndexCelsus' => $_POST['heatIndexCelsus'], 
        'heatIndexFahrenheit' => $_POST['heatIndexFahrenheit'], 
        'dewPoint' => $_POST['dewPoint']
    ];

    $sql = 'INSERT INTO table_dht (
            dht_sensorName, 
            dht_humidity, 
            dht_tempCelsus, 
            dht_tempFahrenheit, 
            dht_heatIndexCelsus, 
            dht_heatIndexFahrenheit, 
            dht_dewPoint)
        VALUES (
            :sensorName, 
            :humidity, 
            :tempCelsus, 
            :tempFahrenheit, 
            :heatIndexCelsus, 
            :heatIndexFahrenheit, 
            :dewPoint)';

    $req = Database::getInstance()->request($sql, $fields);
}

?>