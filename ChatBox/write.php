<?php

date_default_timezone_set('Europe/Brussels');

function chatbox_send_message() : void
{
    if(is_logged() && isset($_POST['message_user']) && !empty($_POST['message_user']))
    {
        $text = "<div class='msgln' title=".date("d-m-Y_H:i:s")."> <strong>".$_SESSION['username']."</strong>: ".stripslashes(htmlspecialchars($_POST['message_user']))."<br></div>"."\r\n";

        $fic = fopen("../ChatBox/log.html", 'a');
        fwrite($fic, $text);
        fclose($fic);
        unset($_POST, $text);
        $_POST = array();
    }
}

function chatbox_logout_message() : void
{
    if(isset($_SESSION['username']) && !empty($_SESSION['username']))
    {
        $text = "<div class='msgln' title=".date("d-m-Y_H:i:s")."> <em>User ". $_SESSION['username']." a quitté la session de chat.</em><br></div>"."\r\n";
        
        $fic = fopen("ChatBox/log.html", 'a');
        fwrite($fic, $text);
        fclose($fic);
        unset($_POST, $text);
        $_POST = array();
    }
}

function chatbox_users_online() : void
{
    if(is_logged())
        if(isset($_SESSION['username']) && !empty($_SESSION['username']))
        {
            $text = "".$_SESSION['username']."\r\n";
            $fic = fopen("../ChatBox/online.html", 'a');
            fwrite($fic, $text);
            fclose($fic);
            unset($_POST, $text);
            $_POST = array();
        }
}

?>