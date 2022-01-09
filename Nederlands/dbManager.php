<?php
require '../util.php';
init_php_session();

if(is_logged()):
require '../Database/Database.php';
// require_once 'util.php';

echo 'fichier DataBase';

$data = [];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Nederlandse databank</title>
</head>
<body>
	<header>
        <h1>Nederlandse databank</h1>
    </header>
    <main>
        <section>
            <h1></h1>
            <div>
                <h2>Woordenschat</h2>

                <?php
    function _csv_to_array(string $path) : array
    {
        $myFile = fopen($path, "r");
        if(!$myFile)
            exit("Ouverture du fichier impossible");//die()
        
        $data = [];
        $head = explode(",", trim(fgets($myFile), "\r\n"));
        while(!feof($myFile))
            array_push($data, array_combine($head, explode(',', fgets($myFile))));

        if(!fclose($myFile))
            exit("Fermeture du fichier echouee");
        else
            return $data;
    }

    function array_to_sql(array $data) : void
    {
        $sql = "CREATE TABLE IF NOT EXISTS `nl_woordenschat`
        (
            `id_woordenschat` INT NOT NULL AUTO_INCREMENT, 
            `woordenschat_woord` VARCHAR(255) NOT NULL UNIQUE,
            `woordenschat_vertaling` VARCHAR(255) NOT NULL UNIQUE,
            PRIMARY KEY(`id_woordenschat`)
        );";
        
        foreach($data as $fields)
            foreach($fields as $key => $value){
                echo '<p>'.$key.' / '.$value.'<p>';
            }

    }

    $data = _csv_to_array("docs/woorden.csv");
    array_to_sql($data);


                ?>

                    


            </div>
            <div>
                <h2>Werkwoord</h2>
            </div>
            <div>
                <h2>Vragen</h2>
            </div>
        </section>
    </main>
    <aside></aside>
    <footer></footer>
</body>
</html>

<?php endif; ?>