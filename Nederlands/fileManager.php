<?php

require 'util.php';
define('ROWS', 10);
$data = csv_to_array_03('docs/woorden2.csv');
?>

<form class="oefening_form" name="oefening_form" action="" method="post">
<fieldset form="oefening_form">
    <legend>Oefening en woordenschat <?php echo count_test_to_1($data).'|'.count($data) ?></legend>

<?php
echo '<div>';

    for($i=0; $i < ROWS; $i++)
    {
        echo '<br><strong>'.$data[$i]['vertaling'].'</strong><br>';
        if(isset($_POST['valid_oefening']) && !empty($_POST['valid_oefening']))
        {
            if(isset($_POST[$i]) && !empty($_POST[$i]))
            {
                echo '<input type="text" class='.$i.' name='.$i.' placeholder="'.$_POST[$i].'" size="25">';
                if($_POST[$i] == $data[$i]['woord'])
                {
                    $data[$i]['test'] = "1"."\n";
                    echo '<em>Prima !</em></br>
                        '.$data[$i]['woord'].' ('.$data[$i]['woorden'].') = '.$data[$i]['vertaling'];
                    if($data[$i]['bijvoorbeld'])
                        echo '<br>bvb : '.$data[$i]['bijvoorbeld'];
                    if($data[$i]['toelichting'])
                        echo '<br>'.$data[$i]['toelichting'];
                }
                else
                {
                    echo '<em>False : </em>'.$data[$i]['woord'];
                }
                
            }
            else
            {
                echo '<em>Niets : </em>'.$data[$i]['woord'];
            }
            echo '<br>';
        } else {
            echo '<input type="text" class='.$i.' name='.$i.' size="25">';
        }
    }

    if(isset($_POST['valid_oefening']) && !empty($_POST['valid_oefening']))
    {
        $data = sort_array_by_test($data);
        array_to_csv($data,'docs/woorden2.csv');
        // header('fileManager.php'); 
    }

    if(isset($_POST['delete_oefening']) && !empty($_POST['delete_oefening']))
    {
        $_POST = array();
        header(); 
    }

    if(isset($_POST['reset_oefening']) && !empty($_POST['reset_oefening']))
    {
        $data = csv_to_array_03('docs/woorden.csv');
        array_to_csv($data,'docs/woorden2.csv');
    }

    $_POST = array();

echo '</div></br></br>';
?>

    <input type="submit" name="valid_oefening" class="valid_oefening" value="valider">
    <input type="submit" name="next_oefening" class="next_oefening" value="suivant">
    <input type="submit" name="reset_oefening" class="reset_oefening" value="réinitialiser">
    <input type="reset" value="effacer">
</fieldset>
</form>