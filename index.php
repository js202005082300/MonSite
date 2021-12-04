<?php
require 'forms/log.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Page d'acceuil</title>
</head>
<body class="container">
	<header class="item">
		<h1>Page d'acceuil</h1>
	</header>

    <main class="item">
        <section>
            <h1>Connexion</h1>
            <div>
                <h2></h2>

                <?php if($attempt_failed > 0): ?>
                    <p>Indentifiant ou mot de passe incorrect</p>
                <?php endif; ?>

                <?php if(is_logged()): ?>
                    <p>Bienvenue <?= htmlspecialchars($_SESSION['username']) ?> | <a href="index.php?action=logout">Se déconnecter</a></p>
                <?php else: ?>
                    <form method="post">
                        <fieldset form="log_form">
                            <legend>Connexion</legend>

                            <input type="text" name="form_username" placeholder="Identifiant...">
                            <input type="password" name="form_password" placeholder="Mot de passe...">
                            <input type="submit" name="valid_connection" value="connexion">

                        </fieldset>
                    </form>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <aside>
    <?php if(is_logged()): ?>
        <p><a href="Sensor/DataDisplay.php">Affichage de données &raquo;</a></p>
        <p><a href="Forms/clientForm.php">Formulaire client &raquo;</a></p>
        <p><a href="Forms/registration.php">Formulaire d'enregistrement &raquo;</a></p>
    </aside>
    <?php endif; ?>
    <footer></footer>
</body>
</html>