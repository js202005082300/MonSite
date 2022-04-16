<?php
require 'util.php';

// $ha = password_hash('', PASSWORD_BCRYPT);
// echo $ha;

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

	<header>
        <!-- <h1>Samuel Jacquet</h1> -->



        <!-- DEVELOPPEMENT -->
        <!-- <nav>
            <div class="navbar">

                <div class="nav-container">

                    <input class="checkbox" type="checkbox" name="" id="" />

                    <div class="hamburger-lines">
                        <span class="line line1"></span>
                        <span class="line line2"></span>
                        <span class="line line3"></span>
                    </div>

                    <div class="logo">
                        <h1>SAMUEL JACQUET</h1>
                        <span class="line line4"></span>
                    </div>

                    <div class="menu-items">
                        <li class="menu-item"><a href="#">Home</a></li>
                        <li class="menu-item"><a href="#">about</a></li>
                        <li class="menu-item"><a href="#">DreamPics</a></li>
                        <li class="menu-item"><a href="#">blogs</a></li>
                        <li class="menu-item"><a href="#">msn</a></li>
                        <li class="menu-item"><a href="#">contact</a></li>
                    </div>

                </div>
                
            </div>
        </nav> -->
        <!-- FIN DEVELOPPEMENT -->




        <!-- <div class="couverture"><img alt="Jap" src="Documents/images/hogancampbw.jpg"></div> -->
	</header>

    <main class="item">
        <h2>Bienvenue</h2>
        <p>Je suis une page web développée en Php</p>
        <?php if(is_logged()): ?>
            <section id="Message">
                <details>
                    <summary>Laisser un message</summary>
                    <p>Avez vous quelques chose à dire ?</p>
                    <?php require_once 'Mailing/mailerForm.php'; ?>
                </details>
            </section>
            <section id="Reseaux">
                <details>
                    <summary>Suivez-nous sur les réseaux</summary>
                    <?php require_once 'Social/social.php'; ?>
                </details>
            </section>
        <?php endif; ?>
    </main>

    <aside>

        <section class="connection">
            <?php require 'Connection/log.php'; ?>
        </section>

        <section class="liens">
            <?php if(is_logged()): ?>
                <nav>
                    <ul>
                        <li><a href="Sensor/DataDisplay.php">Affichage de données &raquo;</a></li>
                        <li><a href="Forms/clientForm.php">Formulaire client &raquo;</a></li>
                        <li><a href="Forms/registration.php">Formulaire d'enregistrement &raquo;</a></li>
                        <li><a href="ChatBox/chat.php">Chat Box &raquo;</a></li>
                        <li><a href="Database/execute.php">Exécuter fichier source MySQL &raquo;</a></li>
                        <li><a href="Nederlands/main.php">Nederlands &raquo;</a></li>
                    </ul>
                </nav>
            <?php endif; ?>
        </section>
        
    </aside>

    <script>

    </script>
    
    <!-- <footer>        
        <p><time datetime="2022-03-12"></time>Copyright &copy; 2022 : Aucuns droits réservés.</p>
    </footer> -->
</body>
</html>