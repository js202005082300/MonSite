<?php
display_messages_from_file();

function display_messages_from_file(): void
{
    if(file_exists("log.html") && filesize("log.html") > 0)
    {
        $ficArray = array_reverse(file("log.html"));
        foreach($ficArray as $el)
            echo $el;
    }
}
?>