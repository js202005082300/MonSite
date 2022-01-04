<?php
define('ROWS', 10);
$data = csv_to_array_03('docs/woorden.csv');
// array_display($data);
$i=0;
$j = 0;
// shuffle($data);

?>

<form class="oefening_form" name="oefening_form" action="" method="post">
<fieldset form="oefening_form">
    <legend>Oefening en woordenschat</legend>

<?php
echo '<div>';
    for(; $i < ROWS; $i++)
    {
        echo $data[$i]['vertaling'].'<br>';
        echo '<input type="text" class='.$i.' name='.$i.' size="25">';
        if(isset($_POST[$i]) && !empty($_POST[$i]))
        {
            if($_POST[$i] == $data[$i]['woord'])
            {
                $data[$i]['test'] = 1;
                echo '<strong>Prima !</strong></br>
                    '.$data[$i]['woord'].' ('.$data[$i]['woorden'].') = '.$data[$i]['vertaling'];
                if($data[$i]['bijvoorbeld'])
                    echo '<br>bvb : '.$data[$i]['bijvoorbeld'];
                if($data[$i]['toelichting'])
                    echo '<br>'.$data[$i]['toelichting'];

                $_POST = array();
            }
            else
                echo '<strong>Error : </strong>'.$data[$i]['woord'];
        }
        echo '<br>';
    }
echo '</div>';
?>

    <input type="submit" name="valid_oefening" class="valid_oefening" value="valider">
</fieldset>
</form>

<?php

//---------------------------------------

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

function csv_to_array_03(string $path) : array
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
        if($coma != 4)
            echo 'Numéro de ligne : '.$line.' | Nombre de virgule : '.$coma.'<br>';
    
        $line++;
    }
    
    if(!fclose($myFile))
        exit("Fermeture du fichier echouee");
}

function array_display($a) : void
{
    // echo $data[0][4];
    echo '<pre>';
    print_r($a);
    echo '</pre>';
}

function benchmark() : void
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
    $data = csv_to_array_03("docs/woorden.csv");
    $fin = microtime(true); 
    $temps_03 = ($fin - $debut);
    echo "csv_to_array_03 : ".$temps_03." sec<br>";
    
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