<?php

function sort_array_by_test(array $arr) : array
{
    $a1 = $a2 = [];
    foreach($arr as $el)
    {
        if($el['test'] == 0 || $el['test'] == "test")
            array_push($a1, $el);
        if($el['test'] == 1)
            array_push($a2, $el);
    }

    if(substr($a1[array_key_last($a1)]['test'], -1) != "\n")
        $a1[array_key_last($a1)]['test'] .= "\n";

    foreach($a2 as $el)
        array_push($a1, $el);

    return $a1;
}

function count_test_to_1(array $arr) : int
{
    $count = 0;

    foreach($arr as $el)
        if($el['test'] == 1)
            $count++;
    
    return $count;
}

function csv_to_array(string $path) : array
{
    $myFile = fopen($path, "r");
    if(!$myFile)
        exit("Ouverture du fichier impossible");//die()
    
    $data = [];
    $head = explode(",", trim(fgets($myFile), "\r\n"));
    while(!feof($myFile))
        array_push($data, array_combine($head, explode(',', fgets($myFile))));

    if(!fclose($myFile))
        exit("Fermeture du fichier echouee");
    else
        return $data;
}

function array_to_csv(array $arr, string $path) : void
{    
    $myFile = fopen($path, 'w');
	if(!$myFile)
		exit("Ouverture du fichier impossible");

    $head = array_keys($arr[0]);
    $str = "";
    foreach($head as $el)
        $str .= $el.',';

    $str = substr($str, 0, -1)."\n";
    fwrite($myFile, $str);

    $str = "";
    foreach($arr as $fields){
        $line = "";

        foreach($fields as $el)
        {
            if(substr($el, -1) != "\n" && end($fields) != $el)
                $line .= $el.',';
            else
                $line .= $el;
        }
        $str .= $line;
    }

    fwrite($myFile, rtrim($str, "\n"));

    if(!fclose($myFile))
        exit("Fermeture du fichier echouee");
}

function csv_to_array_01(string $path) : array
{
    $csv = file_get_contents($path, FILE_USE_INCLUDE_PATH);
    $lines = explode("\n", $csv);
    $head = str_getcsv(array_shift($lines));
    
    $data = array();
    foreach ($lines as $line)
        $data[] = array_combine($head, str_getcsv($line));
    
    return $data;
}

function csv_to_array_02(string $path) : array
{
    $myFile = fopen($path, "r");
    if(!$myFile)
        exit("Ouverture du fichier impossible");//die()
    
    $data = [];
    $head = explode(",", trim(fgets($myFile), "\r\n"));
    while (($line = fgetcsv($myFile, 0, ",")) !== FALSE)
        array_push($data, array_combine($head, $line));
    
    if(!fclose($myFile))
        exit("Fermeture du fichier echouee");
    else
        return $data;
}

function csv_to_object(string $path) : object
{
    $myFile = fopen($path, "r");
    if(!$myFile)
        exit("Ouverture du fichier impossible");//die()

    $head = explode(",", trim(fgets($myFile), "\r\n"));

    $data = new ArrayObject();
    while (($line = fgets($myFile)) !== FALSE)
        $data->append(array_combine($head, str_getcsv($line)));
    
    if(!fclose($myFile))
        exit("Fermeture du fichier echouee");
    else
        return $data;
}

function count_commas_per_line(string $path) : void
{
    $myFile = fopen($path, "r");
    if(!$myFile)
        exit("Ouverture du fichier impossible");//die()
    
    $line = 1;
    while(!feof($myFile))
    {
        $str = fgets($myFile);
        $coma = substr_count($str, ',');
        if($coma != 5)
            echo 'Numéro de ligne : '.$line.' | Nombre de virgule : '.$coma.'<br>';
    
        $line++;
    }
    
    if(!fclose($myFile))
        exit("Fermeture du fichier echouee");
}

function array_display($arr) : void
{
    // echo $data[0][4];
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

function test_benchmark() : void
{
    $debut = microtime(true); 
    $data = csv_to_array_01("docs/woorden.csv");
    $fin = microtime(true); 
    $temps_01 = ($fin - $debut);
    echo "csv_to_array_01 : ".$temps_01." sec<br>";
    
    $debut = microtime(true); 
    $data = csv_to_array_02("docs/woorden.csv");
    $fin = microtime(true); 
    $temps_02 = ($fin - $debut);
    echo "csv_to_array_02 : ".$temps_02." sec<br>";
    
    $debut = microtime(true); 
    $data = csv_to_array("docs/woorden.csv");
    $fin = microtime(true); 
    $temps_03 = ($fin - $debut);
    echo "csv_to_array : ".$temps_03." sec<br>";
    
    $debut = microtime(true); 
    $data = csv_to_object("docs/woorden.csv");
    $fin = microtime(true); 
    $temps_04 = ($fin - $debut);
    echo "csv_to_object : ".$temps_04." sec<br>";
    
    if($temps_01 < $temps_02 && $temps_01 < $temps_03 && $temps_01 < $temps_04)
        echo 'Le vainqueur est $temps_01<br>';
    
    if($temps_02 < $temps_01 && $temps_02 < $temps_03 && $temps_02 < $temps_04)
        echo 'Le vainqueur est $temps_02<br>';
    
    if($temps_03 < $temps_01 && $temps_03 < $temps_02 && $temps_03 < $temps_04)
        echo 'Le vainqueur est $temps_03<br>';
    
    if($temps_04 < $temps_01 && $temps_04 < $temps_02 && $temps_04 < $temps_03)
        echo 'Le vainqueur est $temps_04<br>';
}
?>