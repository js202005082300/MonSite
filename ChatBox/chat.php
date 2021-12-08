<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Chat module</title>
</head>
<body>
    <div class="wrapper">

        <div class="menu">
            <p class="welcome">Bienvenue, <b></b></p>
            <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
        </div>

        <div class="chatbox"></div>

        <div class="message">
            <form class="message_form" name="message_form" action="">
                <input type="text" name="message_user" id="message_user" size="65">
                <input type="submit" name="valid_message" id="valid_message" value="valider">
            </form>
        </div>

    </div> 


    <script type="text/javascript">
    // jQuery Document
    $(document).ready(function(){
    
    });
    </script>
</body>
</html>