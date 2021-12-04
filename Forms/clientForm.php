<?php

require '../Database/Database.php';

if(isset($_POST['valid_client']))
{
	if(isset($_POST['client_firstname']) && !empty($_POST['client_firstname']))
		if(isset($_POST['client_lastname']) && !empty($_POST['client_lastname']))
			if(isset($_POST['client_gender']) && !empty($_POST['client_gender']))
				if(isset($_POST['client_birthday']) && !empty($_POST['client_birthday']))
					if(isset($_POST['client_email']) && !empty($_POST['client_email']))
						if(isset($_POST['client_tel']) && !empty($_POST['client_tel']))
						{

							$fields = [
								'firstname' => $_POST['client_firstname'],
								'lastname' => $_POST['client_lastname'],
								'gender' => $_POST['client_gender'],
								'birthday' => $_POST['client_birthday'],
								'email' => $_POST['client_email'],
								'tel' => $_POST['client_tel']
							];

$sql = 'INSERT INTO table_clients (client_firstname, client_lastname, client_gender, client_birthday, client_email, client_tel) VALUES (:firstname, :lastname, :gender, :birthday, :email, :tel)';

							try
							{
								$req = Database::getInstance()->request($sql, $fields);
								unset($req);
							}
							catch(PDOException $pe)
							{
								echo 'ERREUR : '.$pe->getMessage();
							}

							unset($_POST, $request, $sql, $fields);
							header('Location: clientForm.php');
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
		<fieldset form="client_form">
				<legend>Formulaire client</legend>

		<p><label for="firstname">Prénom</label> : <input type="text" id="firstname" name="client_firstname"></p>

		<p><label for="lastname">Nom</label> : <input type="text" id="lastname" name="client_lastname"></p>

		<p><label for="gender">Genre</label> :  
		<input type="radio" id="gender" name="client_gender" value="H">Homme 
		<input type="radio" id="gender" name="client_gender" value="F">Femme</p>

		<p><label for="birthday">Date naissance</label> : <input type="date" id="birthday" name="client_birthday"></p>

		<p><label for="email">Email</label> : <input type="email" id="email" name="client_email"></p>

		<p><label for="tel">Tel</label> : <input type="tel" id="tel" name="client_tel"></p>

		<p><input type="reset" value="effacer">
		<input type="submit" name="valid_client" value="valider"></p>

		</fieldset>
	</form>

    <p><a href="../index.php">&laquo; Retour à l'acceuil</a></p>
</body>
</html>