<?php

if(is_admin()):
require '../Database/Database.php';

$different_password = 0;
$name_exists = 0;
$email_exists = 0;
$username = '';
$email = '';
$hash = '';

if(isset($_POST['registration_username']) && !empty($_POST['registration_username']))
{
    $username = $_POST['registration_username'];
    $sql = "SELECT count(*) AS '0' FROM table_users WHERE user_name='".$username."';";
    $req = Database::getInstance()->request($sql, NULL, False);
    if($req[0])
        $name_exists = True;
}
    
if(isset($_POST['registration_email']) && !empty($_POST['registration_email']))
{
    $email = $_POST['registration_email'];
    $sql = "SELECT count(*) AS '0' FROM table_users WHERE user_email='".$email."';";
    $req = Database::getInstance()->request($sql, NULL, False);
    if($req[0])
        $email_exists = True;
}

if(isset($_POST['registration_password']) && !empty($_POST['registration_password']))
    if(isset($_POST['registration_password_verif']) && !empty($_POST['registration_password_verif']))
        if($_POST['registration_password'] == $_POST['registration_password_verif'])
            $hash = password_hash($_POST['registration_password'], PASSWORD_BCRYPT);
        else
            $different_password = 1;


if((!$different_password && !$name_exists && !$email_exists) && ($username && $email && $hash))
{
    $fields =
    [
        'username' => $username,
        'email' => $email,
        'password' => $hash
    ];
    $sql = 'INSERT INTO table_users (user_name,user_email,user_password) VALUES (:username,:email,:password)';
    $requ = Database::getInstance()->request($sql, $fields);

    header('Location:registration.php?inserted');
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

	<form method="post">
		<fieldset form="user_form">
				<legend>Nouvel utilisateur</legend>

        <?php if(isset($_GET['inserted'])): ?>
            <p>Statut : Données insérées !</p>
        <?php else: ?>
            <p>Statut : Enregistrez-vous ...</p>

            <p><label for="registration_username">Nom d'utilisateur</label> : <input type="text" id="registration_username" name="registration_username" value='<?=$username?>'>

            <?php if($name_exists): ?>
                <b>Nom d'utilisateur existe déjà !</b></p>
            <?php endif; ?>

            <p><label for="registration_email">Email</label> : <input type="email" id="registration_email" name="registration_email" value='<?=$email?>'>

            <?php if($email_exists): ?>
                <b>E-mail existe déjà !</b></p>
            <?php endif; ?>

            <p><label for="registration_password">Mot de passe</label> : <input type="password" id="registration_password" name="registration_password"></p>

            <p><label for="registration_password_verif">Répeter le mot de passe</label> : <input type="password" id="registration_password_verif" name="registration_password_verif"> 

            <?php if($different_password): ?>
                <b>Mot de passe différent</b></p>
            <?php endif; ?>

            <p><input type="reset" value="effacer">
            <input type="submit" name="valid_registration" value="valider"></p>

        <?php endif; ?>

		</fieldset>
	</form>
<?php endif; ?>

    <p><a href="../index.php">&laquo; Retour à l'acceuil</a></p>

<?php if(is_admin()):?>
</body>
</html>
<?php endif; ?>