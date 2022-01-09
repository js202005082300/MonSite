<?php
require '../util.php';
init_php_session();
if(is_logged()):

define("ROWS", 12);
define("FILE_SOURCE", "docs/woorden.csv");
define("MY_FILE", "docs/woorden_".htmlspecialchars($_SESSION['username']));
?>

<?php
require 'util_fileManager.php';

// count_commas_per_line($FileSource);
// die();

if(!file_exists(MY_FILE) || (isset($_POST['reset_oefening']) && !empty($_POST['reset_oefening'])))
{
    $data = csv_to_array(FILE_SOURCE);
    array_to_csv($data,MY_FILE);
    $_POST = array();
}

$data = csv_to_array(MY_FILE);
?>

<form class="oefening_form" name="oefening_form" action="" method="post">
<fieldset form="oefening_form">
    <legend>Oefening en woordenschat <?php echo count_test_to_1($data).'|'.count($data) ?></legend>

<?php
echo '<div>';
// echo '<style>.green{text-decoration-color:green;}.red{text-decoration-color:red;}</style>';

    for($i=0; $i < ROWS; $i++)
    {
        echo '<br><strong>'.$data[$i]['vertaling'].'</strong><br>';
        if(isset($_POST['valid_oefening']) && !empty($_POST['valid_oefening']))
        {
            if(isset($_POST[$i]) && !empty($_POST[$i]))
            {
                if($_POST[$i] == $data[$i]['woord'])
                {
                    echo '<input type="text" class="'.$i.' green" name='.$i.' placeholder="'.$_POST[$i].'" size="25">';
                    $data[$i]['test'] = "1"."\n";
                    echo '<em>Juist, prima !</em></br>
                        '.$data[$i]['woord'].' ('.$data[$i]['woorden'].') = '.$data[$i]['vertaling'];
                    if($data[$i]['bijvoorbeld'])
                        echo '<br>'.$data[$i]['bijvoorbeld'];
                    if($data[$i]['toelichting'])
                        echo '<br>'.$data[$i]['toelichting'];
                }
                else
                {
                    echo '<input type="text" class="'.$i.' red" name='.$i.' placeholder="'.$_POST[$i].'" size="25">';
                    echo '<em>Niet juist : </em>'.$data[$i]['woord'];
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
        array_to_csv($data, MY_FILE);
    }
    
    if(isset($_POST['delete_oefening']) && !empty($_POST['delete_oefening']))
    {
        $_POST = array();
        header('Location : main.php');
    }

echo '</div></br></br>';
?>
    <?php if(isset($_POST['valid_oefening']) && !empty($_POST['valid_oefening'])): ?>
        <input type="submit" name="next_oefening" class="next_oefening" value="suivant">
        <?php $_POST['valid_oefening'] = NULL; ?>
    <?php else: ?>
        <input type="submit" name="valid_oefening" class="valid_oefening" value="valider">
        <input type="reset" value="effacer">
    <?php endif; ?>
    <input type="submit" name="reset_oefening" class="reset_oefening" value="réinitialiser">
</fieldset>
</form>

<?php endif; ?>