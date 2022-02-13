<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Nederlands</title>
</head>
<body class="container">
    <header>
        <?php //require_once "dbManager.php"; ?>
    </header>

    <main>
        <?php require_once "curlManager.php"; ?>
    </main>

    <aside>
        <!-- <form class="choice_form" name="choice_form" action="" method="post">
            <fieldset form="choice_form">
                <legend>Mijn deel van keuze</legend>

                <select name="choice_oefening" class="choice_oefening" size="3">
                    <option value="Woorden">Woorden</option>
                    <option value="Werkwoorden">Werkwoorden</option>
                    <option value="Vragen">Vragen</option>
                </select>

                <br><input type="submit" name="valid_choice" class="valid_choice" value="Envoyer">
            </fieldset>
        </form> -->

        <?php 
        // if(isset($_POST['valid_choice']) && !empty($_POST['valid_choice']))
        //     switch($_POST['choice_oefening']){
        //         case "Woorden":
        //             require_once "woordenManager.php";
        //             break;
        //         case "Werkwoorden":
        //             require_once "werkwoordenManager.php";
        //             break;
        //         case "Vragen":
        //             require_once "vragenManager.php";
        //             break;
        //         default:
        //             die();
        //     }
        // require_once "werkwoordenManager.php";
        // require_once "vragenManager.php";
        require_once "woordenManager.php";
        ?>
    </aside>

    <footer>

    </footer>

    <script>
        $(document).ready(

        );
    </script>

    <p><a href="../index.php">&laquo; Retour à l'acceuil</a></p>
</body>
</html>