<?php

require '../Database/Database.php';

$attempt_failed = 0;

if(isset($_POST['valid_registration']))
{
	if(isset($_POST['registration_username']) && !empty($_POST['registration_username']))
        if(isset($_POST['registration_email']) && !empty($_POST['registration_email']))
            if(isset($_POST['registration_password']) && !empty($_POST['registration_password']))
                if(isset($_POST['registration_password_verif']) && !empty($_POST['registration_password_verif']))
                {
                    if($_POST['registration_password'] == $_POST['registration_password_verif'])
                    {
                        $hash = password_hash($_POST['registration_password'], PASSWORD_BCRYPT);
                    
                        $fields = [
                            'username' => $_POST['registration_username'],
                            'email' => $_POST['registration_email'],
                            'password' => $hash
                        ];
        
                        $sql = 'INSERT INTO table_users (user_name, user_email, user_password) VALUES (:username, :email, :password)';
        
                        try
                        {
                            $req = Database::getInstance()->request($sql, $fields);
                        }
                        catch(PDOException $pe)
                        {
                            //echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
                            echo 'ERREUR : '.$pe->getMessage();
                        }

                        $attempt_failed = 0;
                        unset($_POST, $request, $sql, $fields);
                        header('Location: registration.php');
                    }
                    else
                    {
                        $attempt_failed = 1;
                    }
                }
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

		<p><label for="registration_username">Nom d'utilisateur</label> : <input type="text" id="registration_username" name="registration_username"></p>

        <p><label for="registration_email">Email</label> : <input type="email" id="registration_email" name="registration_email"></p>

		<p><label for="registration_password">Mot de passe</label> : <input type="password" id="registration_password" name="registration_password"></p>

        <p><label for="registration_password_verif">Répeter le mot de passe</label> : <input type="password" id="registration_password_verif" name="registration_password_verif"></p>

        <?php if($attempt_failed > 0): ?>
            <p><b>Mot de passe différent</b></p>
        <?php endif; ?>

        <p><input type="reset" value="effacer">
		<input type="submit" name="valid_registration" value="valider"></p>

		</fieldset>
	</form>

    <p><a href="../index.php">&laquo; Retour à l'acceuil</a></p>
</body>
</html>