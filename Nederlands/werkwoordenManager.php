<?php
require '../util.php';
init_php_session();
if(is_logged()):

define("ROWS", 10);
define("FILE_SOURCE", "docs/werkwoorden.csv");
define("MY_FILE", "docs/werkwoorden_".htmlspecialchars($_SESSION['username']));
?>

<?php
require 'util_fileManager.php';

// count_commas_per_line(FILE_SOURCE, 3);
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
    <legend>Oefening over vragen <?php echo count_test_to_1($data).'|'.count($data) ?></legend>
    <style>.green{text-decoration-color:green;}.red{text-decoration-color:red;}</style>
<div>
    <?php
    for($i=0; $i<ROWS; $i++)
    {  
        if(isset($data[$i]) && !empty($data[$i]))
        {
            $question = $data[$i]['vertaling'];
            $response = $data[$i]['infinitief'];
            $info = $data[$i]['toelichting'];

            echo '<br><strong>'.$question.'</strong><br>';
            if(isset($_POST['valid_oefening']) && !empty($_POST['valid_oefening']))
            {
                if(isset($_POST[$i]) && !empty($_POST[$i]))
                {
                    $response_user = htmlspecialchars($_POST[$i]);
                    
                    if($response_user == $response)
                    {
                        $data[$i]['test'] = "1"."\n";

                        echo '<input type="text" class="'.$i.' green" name='.$i.' placeholder="'.$response_user.'" size="30">';
                        echo '<em>Juist, prima !</em></br>';
                        echo $response.'.</br>';
                        echo $question.'</br>';

                        if($info) echo $info;
                    }
                    else
                    {
                        echo '<input type="text" class="'.$i.' red" name='.$i.' placeholder="'.$response_user.'" size="30">';
                        echo '<em>Niet juist : </em>'.$response;
                    }
                }
                else
                {
                    echo '<em>Niets : </em>'.$response;
                }
                echo '<br>';
            } else {
                echo '<input type="text" class='.$i.' name='.$i.' size="30">';
            }
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

    ?>
</div></br></br>
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