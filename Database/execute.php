<?php 
    require '../util.php';
    init_php_session();

if(is_admin()): ?>

<?php
    require 'extract.php';

    if(isset($_POST['valid_execute']))
    {
        $sql = run_sql_file("mydb.sql");
        print_r($sql);
        echo "<p><a href='../index.php'>&laquo; Retour à l'acceuil</a></p>";
    }
?>

<form method="post">
        <fieldset form="source_form">
        <legend>Bouton d'exécution MySQL</legend>
<input type="submit" name="valid_execute" value="Requête execute" />
        </fieldset>
</form>

<?php endif; ?>

<p><a href="../index.php">&laquo; Retour à l'acceuil</a></p>