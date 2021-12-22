<?php

require 'DataBase.php';

function run_sql_file($location){
    //load file
    $commands = file_get_contents($location);

    //delete comments
    $lines = explode("\n",$commands);
    $commands = '';
    foreach($lines as $line){
        $line = trim($line);
        if( $line && !startsWith($line,'--') ){
            $commands .= $line . "\n";
        }
    }

    //convert to array
    $commands = explode(";", $commands);

    //run commands
    $total = $results = 0;
    foreach($commands as $command){
        if(trim($command)){
            $req = Database::getInstance()->request($command);
            $results += (@$req==true ? 1 : 0);
            $total += 1;
        }
    }

    //return number of successful queries and total number of queries found
    return array(
        "results" => $results,
        "total" => $total
    );
}

// Here's a startsWith function
function startsWith($haystack, $needle){
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}