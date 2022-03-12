<?php

if (isset($_POST["valid_mail"]))
{
    if(isset($_POST['mail_name']) && !empty($_POST['mail_name']))
        if(isset($_POST['mail_email']) && !empty($_POST['mail_email']))
            if(isset($_POST['mail_message']) && !empty($_POST['mail_message']))
            {            
                $to = "js201910271235@outlook.com";
                $subject = "Utilisation de mail() avec PHP depuis GNU/Linux";
                $message = $_POST['mail_message'];
                
                $headers = "Content-Type: text/plain; charset=utf-8\r\n";
                $headers .= "From: js202002080712@gmail.com\r\n";
                
                if(mail($to, $subject, $message, $headers))
                    echo 'Envoye !';
                else
                    echo 'Erreur envoi';
            }
}
// https://www.hostinger.com/tutorials/send-emails-using-php-mail#:~:text=To%20use%20the%20PHP%20send%20mail%20feature%2C%20users,a%20hosting%20server%2C%20Sendmail%20is%20usually%20already%20configured.
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire de contact</title>
</head>
<body>
    <?php if (!empty($responseText)) {
        echo "<h2>$responseText</h2>";
        echo "Salut : ";
        echo $_POST['mail_message'];
    } ?>
    <form method="post">
        <fieldset form="mail_form">
            <legend>Formulaire mail</legend>
            <label for="name">Nom: <input type="text" id="name" name="mail_name"></label><br><br>
            <label for="email">Email: <input type="email" id="email" name="mail_email"></label><br><br>   
            <label for="message">Message: <textarea id="message" name="mail_message" rows="8" cols="20"></textarea></label><br><br>
            <input type="submit" name="valid_mail" value="Envoyer">
        </fieldset>
    </form>
</body>
</html>