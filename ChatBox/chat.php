<?php
require '../Database/Database.php';
require '../util.php';
require 'write.php';

init_php_session();

if(is_logged()):

chatbox_send_message();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <link rel="stylesheet" href="chat.css">
    <title>Chat module</title>

</head>
<body>
    <div class="wrapper">

        <div class="menu">
            <?php if(is_logged()): ?>
                    <p class="welcome">Bienvenue, <b><?= htmlspecialchars($_SESSION['username']) ?></b></p>
            <?php endif; ?>

            <p class="logout"><a id="exit" href="../index.php?action=logout">Exit Chat</a></p>
        </div>

        <div class="chathead">
            <p>Petite chatBox : Simple d'utilisation</p>
        </div>
        
        <div class="chatbox">
            <?php require_once 'chatbox.php'; ?>
        </div>

        <div class="chatusers">
            <?php require_once 'chatusers.php'; ?>
        </div>

        <div class="message">
            <form class="message_form" name="message_form" action="" method="post">
                <input type="text" name="message_user" class="message_user" maxlength="80">
                <input type="reset" name="delete_message" class="delete_message" value="effacer">
                <input type="submit" name="valid_message" class="valid_message" value="valider">
            </form>
        </div>

    </div> 

    <script>
        /* @return le chat actualisé en temps réel */
        $(document).ready(function(){
        setInterval(function(){
            $(".chatbox").load(window.location.href + " .chatbox > *");
            // $(".chatusers").load(window.location.href + " .chatusers");
        }, 1000);
        });
    </script>

    <footer>
<?php endif; ?>
        <p><a href="../index.php">&laquo; Retour à l'acceuil</a></p>
<?php if(is_logged()): ?>
    </footer>
</body>
</html>
<?php endif; ?>