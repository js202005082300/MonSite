<p>Salut</p>

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

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Formulaire HTML</title>
</head>
<body>
	<h1>Saisie d'informations</h1>

<div>
    <form method="post">
        <fieldset form="source_form">
        <legend>Bouton d'exécution MySQL</legend>
<input type="submit" name="valid_source" value="Requête Source" />
        </fieldset>
    </form>
</div>

</body>
</html>