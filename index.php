<?php
require 'Database.php';

date_default_timezone_set('Europe/Brussels');
?>

<?php
$dsn = 'mysql:host=localhost;dbname=u870391923_MyDB';
$username = 'u870391923_root';
$password = 'o8jtuHhZPmLXiVUZoj';
try{$conn = new PDO($dsn, $username, $password);}
catch(PDOException $pe){echo $pe->getMessage();}
if($conn){;}
$response=array();

if(isset($_POST['success']) && !empty($_POST['success']))
    if(isset($_POST['temp01']) && !empty($_POST['temp01']))
        if(isset($_POST['hum01']) && !empty($_POST['hum01']))
            if(isset($_POST['temp02']) && !empty($_POST['temp02']))
                if(isset($_POST['hum02']) && !empty($_POST['hum02']))
                {
                    $temp01 = $_POST["temp01"];
                    $hum01 = $_POST["hum01"];
                    $success = $_POST["success"];
                    $sql01="INSERT INTO table_dht(dht_success, dht_temperature, dht_humidity, dht_name, dht_location)
                    VALUES ('$success', '$temp01', '$humidity', 'DHT11_PIN2', 'x')";

                    $temp02 = $_POST["temp02"];
                    $hum02 = $_POST["hum02"];
                    $success = $_POST["success"];
                    $sql02="INSERT INTO table_dht(dht_success, dht_temperature, dht_humidity, dht_name, dht_location)
                    VALUES ('$success', '$temp02', '$hum02', 'DHT11_PIN3', 'x')";

                    try{$conn->query($sql01);$conn->query($sql02);}
                    catch(Exception $pe){echo $pe->getMessage();}
                }

$conn=null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Samuel Jacquet</title>
</head>
<body class="container">
	<header class="item">
		<h1>Tableau de bord</h1>
	</header>

    <main class="item">
        <section>
            <h1>Page de collecte de données</h1>
            <div>
                <h2>Données DHT</h2>
                <table cellspacing="5" cellpadding="5">
                    <tr> 
                        <td>DATE</td>
                        <td>NAME</td>
                        <td>HUMIDITY</td> 
                        <td>TEMPERATURE</td> 
                        <td>SUCCESS</td> 
                    </tr>
                    <?php 
                        $dht_sql = Database::getInstance()->display();
                        foreach($dht_sql as $row):
                            $row_id = $row['id_dht'];
                            $row_date = $row['dht_date'];
                            $row_name = $row['dht_name'];
                            $row_humidity = $row['dht_humidity'];
                            $row_temperature = $row['dht_temperature'];
                            $row_success = $row['dht_success'];
                            $row_date = date("Y-m-d H:i:s");
                            echo '<tr>
                            <td>'.$row_date.'</td>
                            <td>'.$row_name.'</td>
                            <td>'.$row_humidity.'</td>
                            <td>'.$row_temperature.'</td>
                            <td>'.$row_success.'</td>
                            </tr>';
                        endforeach;
                    ?>
                </table>
            </div>
        </section>
    </main>

    <aside class="item">
    </aside>

    <footer class="item">
        <p>Copyright &copy; 2021</p>
    </footer>

</body>
</html>