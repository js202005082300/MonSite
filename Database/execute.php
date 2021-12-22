

<?php
        echo "<p><a href='../index.php'>&laquo; Retour à l'acceuil</a></p>";
    require '../util.php';
    require 'extract.php';

    init_php_session();

    if(isset($_POST['valid_source']))
    {
        $req = run_sql_file("mydb.sql");
        print_r($req);
        echo "<p><a href='../index.php'>&laquo; Retour à l'acceuil</a></p>";
    }
?>

<form method="post">
    <p>Bon on est dans le form</p>
        <fieldset form="source_form">
        <legend>Bouton d'exécution MySQL</legend>
<input type="submit" name="valid_source" value="Requête Source" />
        </fieldset>
</form>