<?php
require '../Database/Database.php';

$fic = "data.csv";
$myFile = fopen($fic, "w");
if(!$myFile)
	exit("Ouverture du fichier impossible");

$sql = 'SELECT * FROM table_dht;';
$req = Database::getInstance()->request($sql, NULL, true);
$headCSV="ID".';'.
        "SENSOR NAME".';'.
        "LOCATION".';'.
        "HUMIDITY".';'.
        "TEMP C".';'.
        "TEMP F".';'.
        "HEAT INDEX C".';'.
        "HEAT INDEX F".';'.
        "DEW POINT"."\r\n";
fwrite($myFile, $headCSV);
foreach($req as $row):
$rowCSV=$row['id_dht'].';'.
        $row['dht_date'].';'.
        $row['dht_sensorName'].';'.
        $row['dht_location'].';'.
        $row['dht_humidity'].';'.
        $row['dht_tempCelsus'].';'.
        $row['dht_tempFahrenheit'].';'.
        $row['dht_heatIndexCelsus'].';'.
        $row['dht_heatIndexFahrenheit'].';'.
        $row['dht_dewPoint']."\r\n";
fwrite($myFile, $rowCSV);
endforeach;

if(!fclose($myFile))
	exit("Fermeture du fichier echouee");

header('Location: data.csv');