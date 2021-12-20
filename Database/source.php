<?php
    require '../util.php';

    init_php_session();
?>

<?php if(is_admin()): ?>

    <form method="post">
        <fieldset form="source_form">
    <input type="submit" name="valid_source" value="Requête Source" />
        </fieldset>
    </form>

    <?php

    require 'DataBase.php';

    function run_sql_file($location){
        //load file
        $commands = file_get_contents($location);

        //delete comments
        $lines = explode("\n",$commands);
        $commands = '';
        foreach($lines as $line){
            $line = trim($line);
            if( $line && !startsWith($line,'--') ){
                $commands .= $line . "\n";
            }
        }

        //convert to array
        $commands = explode(";", $commands);

        //run commands
        $total = $success = 0;
        foreach($commands as $command){
            if(trim($command)){
                $success += (@Database::getInstance()->request($command)==false ? 0 : 1);
                $total += 1;
            }
        }

        //return number of successful queries and total number of queries found
        return array(
            "success" => $success,
            "total" => $total
        );
    }

    // Here's a startsWith function
    function startsWith($haystack, $needle){
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    if(isset($_POST['valid_source']))
    {
        if(run_sql_file("mydb.sql"))
            echo '<p>Intégration réusie.</p>';
        else
            echo '<p>Intégration échouée !</p>';

        echo "<p><a href='../index.php'>&laquo; Retour à l'acceuil</a></p>";
    }
    ?>

<?php endif; ?>