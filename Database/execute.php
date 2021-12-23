<?php
    //require '../util.php';
    //require 'extract.php';

    //init_php_session();

    if(isset($_POST['valid_execute']))
    {
        //run_sql_file("mydb.sql");
        echo "<p><a href='../index.php'>&laquo; Retour à l'acceuil</a></p>";
    }
?>

<form method="post">
    <p>Bon on est dans le form</p>
        <fieldset form="source_form">
        <legend>Bouton d'exécution MySQL</legend>
<input type="submit" name="valid_execute" value="Requête execute" />
        </fieldset>
</form>