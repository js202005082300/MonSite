<?php
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
<?php //if(is_admin()): ?>
    <form method="post">
        <fieldset form="source_form">
    <input type="submit" name="valid_source" value="Requête Source" />
        </fieldset>
    </form>
<?php //endif; ?>