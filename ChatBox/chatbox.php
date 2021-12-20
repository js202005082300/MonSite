<?php
// header("Refresh:1");
// echo date('H:i:s Y-m-d');
test();

function test(): void
{
    if(file_exists("log.html") && filesize("log.html") > 0)
    {
        $ficArray = array_reverse(file("log.html"));
        foreach($ficArray as $el)
            echo $el;
    }
}