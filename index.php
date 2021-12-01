<?php
require 'Database/Database.php';
require 'util.php';

init_php_session();
$attempt_failed = 0;

if(isset($_GET['action']) && !empty($_GET['action'] && $_GET['action'] == "logout"))
{
    clean_php_session();
    header('Location: index.php');
}

if(isset($_POST['valid_connection']))
    if(isset($_POST['form_username']) && !empty($_POST['form_username']) && isset($_POST['form_password']) && !empty($_POST['form_password']))
    {
        $username = $_POST['form_username'];
        $password = $_POST['form_password'];

        $sql = 'SELECT * FROM table_users WHERE user_name = :name';
        $fields = ['name' => $username];
        $req = Database::getInstance()->request($sql, $fields);

        if($req && password_verify($password, $req['user_password']))
        {
            init_php_session();

            $_SESSION['username'] = $username;
            $_SESSION['rank'] = $req['user_admin'];

            $attempt_failed = 0;
        }
        else
        {
            $attempt_failed = 1;
        }
    }
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
                    <input type="text" name="form_username" placeholder="Identifiant...">
                    <input type="password" name="form_password" placeholder="Mot de passe...">
                    <input type="submit" name="valid_connection" value="connexion">
                </form>
            <?php endif; ?>

            </div>
        </section>
    </main>

    <aside>
    <?php if(is_logged()): ?>
        <nav>
            <ul>
                <li><a href="Sensor/DataDisplay.php">>> Affichage de données</a></li>
            </ul>
        </nav>
    </aside>
    <?php endif; ?>
    <footer></footer>
</body>
</html>