<?php
require 'util.php';

init_php_session();
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
		<h1>Bienvenue</h1>
        <p>Bienvenue sur mon Site personnel.</p>
        <?php if(is_logged()): ?>
            <?php //require_once 'Social/social.php'; ?>
        <?php endif; ?>
        <p></p>
	</header>

    <main class="item">
        <?php require 'Connection/log.php'; ?>
    </main>

    <aside>
        <?php if(is_logged()): ?>
            <nav>
                <ul>
                    <li>
        <a href="Sensor/DataDisplay.php">Affichage de données &raquo;</a>
                    </li>
                    <li>
        <a href="Forms/clientForm.php">Formulaire client &raquo;</a>
                    </li>
                    <li>
        <a href="Forms/registration.php">Formulaire d'enregistrement &raquo;</a>
                    </li>
                    <li>
        <a href="ChatBox/chat.php">Chat Box &raquo;</a>
                    </li>
                    <li>
        <a href="Database/source.php">Requête Source &raquo;</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </aside>
    
    <footer>
        
    </footer>
</body>
</html>