<?php
require '../Database/Database.php';
require '../util.php';
require 'write.php';

init_php_session();

if(is_logged()):

chatbox_send_message();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        <div class="chatbox">

            <?php require 'chatbox.php'; ?>

        </div>

        <div class="chatusers">

            <?php require 'chatusers.php'; ?>

        </div>

        <div class="message">
            <form class="message_form" name="message_form" action="" method="post">
                <input type="text" name="message_user" class="message_user" size="65">
                <input type="submit" name="valid_message" class="valid_message" value="valider">
            </form>
        </div>

    </div> 

    <script>
        $.get("chatbox.php", function(data)
        {
            $("#chatbox").append(data);
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