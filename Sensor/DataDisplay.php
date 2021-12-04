<?php
require '../Database/Database.php';
require '../util.php';

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
                        <td>TEMP C</td> 
                        <td>TEMP F</td>
                        <td>HEAT INDEX C</td>
                        <td>HEAT INDEX F</td>
                        <td>DEW POINT</td>
                    </tr>
                    <?php
                    $sql = 'SELECT * FROM table_dht ORDER BY id_dht DESC LIMIT 10;';
                    $req = Database::getInstance()->request($sql, NULL, true);
                    foreach($req as $row):
                        echo '<tr>
                        <td>'.$row['dht_date'].'</td>
                        <td>'.$row['dht_sensorName'].'</td>
                        <td>'.$row['dht_location'].'</td>
                        <td>'.$row['dht_humidity'].'</td>
                        <td>'.$row['dht_tempCelsus'].'</td>
                        <td>'.$row['dht_tempFahrenheit'].'</td>
                        <td>'.$row['dht_heatIndexCelsus'].'</td>
                        <td>'.$row['dht_heatIndexFahrenheit'].'</td>
                        <td>'.$row['dht_dewPoint'].'</td>
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

    <a href="download.php" class="bouton">Télécharger</a>

<?php endif; ?>

    <aside></aside>
    <footer>
        <p><a href="../index.php">&laquo; Retour à l'acceuil</a></p>
    </footer>
</body>
</html>