<?php
require '../Database/Database.php';
require '../util.php';

date_default_timezone_set('Europe/Brussels');

init_php_session();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Données Arduino</title>
</head>
<body>
	<header>
        <h1>Page de collecte de données</h1>
    </header>
<?php if(is_logged()): ?>
    <main>
        <section>
            <h1></h1>
            <div>
                <h2>Données DHT</h2>
                <table cellspacing="5" cellpadding="5">
                    <tr> 
                        <td>DATE</td>
                        <td>SENSOR NAME</td>
                        <td>LOCATION</td>
                        <td>HUMIDITY</td> 
                        <td>TEMP C°</td> 
                        <td>TEMP F°</td>
                        <td>HEAT INDEX C°</td>
                        <td>HEAT INDEX F°</td>
                        <td>DEW POINT</td>
                    </tr>
                    <?php
                    $sql = 'SELECT * FROM table_dht ORDER BY id_dht DESC LIMIT 10;';
                    $req = Database::getInstance()->request($sql, NULL, true);
                    foreach($req as $row):
                        $row_id = $row['id_dht'];
                        $row_date = $row['dht_date'];
                        $row_sensorName = $row['dht_sensorName'];
                        $row_location = $row['dht_location'];
                        $row_humidity = $row['dht_humidity'];
                        $row_tempCelsus = $row['dht_tempCelsus'];
                        $row_tempFahrenheit = $row['dht_tempFahrenheit'];
                        $row_heatIndexCelsus = $row['dht_heatIndexCelsus'];
                        $row_heatIndexFahrenheit = $row['dht_heatIndexFahrenheit'];
                        $row_dewPoint = $row['dht_dewPoint'];
                        echo '<tr>
                        <td>'.$row_date.'</td>
                        <td>'.$row_sensorName.'</td>
                        <td>'.$row_location.'</td>
                        <td>'.$row_humidity.'</td>
                        <td>'.$row_tempCelsus.'</td>
                        <td>'.$row_tempFahrenheit.'</td>
                        <td>'.$row_heatIndexCelsus.'</td>
                        <td>'.$row_heatIndexFahrenheit.'</td>
                        <td>'.$row_dewPoint.'</td>
                        </tr>';
                    endforeach;
                    ?>
                </table>
            </div>
        </section>
    </main>

    <p>Session utilisateur : <?=htmlspecialchars($_SESSION['username'])?>
<?php else: ?>

    <p><a href="../index.php">Page de connection</a>

<?php endif; ?>

<?php if(is_admin()): ?>

    (compte administrateur)</p>

<?php endif; ?>

    <aside></aside>
    <footer></footer>
</body>
</html>