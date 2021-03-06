<?php

class Curl
{
    private $_ch, $_url;
    private static $certificate = "C:\_Projets\MyWAMP\apache\htdocs\MonSiteProd\cacert.pem";

    public function __construct(string $url = null)
    {
        $this->_url = $url;
        $this->_ch = curl_init($url);
        curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, 1);

        if(isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == "localhost"){
            curl_setopt($this->_ch, CURLOPT_CAINFO, self::$certificate);
            curl_setopt($this->_ch, CURLOPT_CAPATH, self::$certificate);
        }
    }

    public function __destruct()
    {
        curl_close($this->_ch);
    }

    public function getPage() : string
    {
        $str = curl_exec($this->_ch);
        if(curl_error($this->_ch))
            return '<br>> '.curl_error($this->_ch).'<br><br>';
        else
            return $str;
    }
}

?>

<div>
    <form class="woord_form" name="woord_form" action="" method="post">
        <fieldset form="woord_form">
            <legend>Vul in met een woord of een werkwoord</legend>
            <input type="text" class="woord_woord" name="woord_woord" size="35">
            <input type="submit" name="valid_woord" class="valid_woord" value="valider">
        </fieldset>
    </form>
    <?php
        if(isset($_POST['woord_woord']) && !empty($_POST['woord_woord']))
        {
            $url1="https://www.mijnwoordenboek.nl/ww.php?woord=".$_POST['woord_woord'];
            $url2="https://www.welklidwoord.be/".$_POST['woord_woord'];
            $url3="https://www.reverso.net/traduction-texte#sl=fra&tl=dut&text=".$_POST['woord_woord'];
            $url4="https://translate.google.be/?hl=fr&sl=nl&tl=fr&op=translate";
            $url5="https://translate.google.be/?hl=fr&sl=fr&tl=nl&op=translate";
            $obj1 = new Curl($url1);
            $str1 = $obj1->getPage();
            $obj2 = new Curl($url2);
            $str2 = $obj2->getPage();

            lidwoord($str2);
            werkwoord($str1);

        echo '<div><nav>';
            echo '<li><a href='.$url1.' target="_blank">mijnwoordenboek.nl</a></li>';
            echo '<li><a href='.$url2.' target="_blank">welklidwoord.be</a></li>';
            echo '<li><a href='.$url3.' target="_blank">reverso.net</a></li>';
            echo '<li><a href='.$url4.' target="_blank">FR>NL (translate.google.be)</a></li>';
            echo '<li><a href='.$url5.' target="_blank">NL>FR (translate.google.be)</a></li>';
        echo '</div></nav>';
        }
    ?>
</div>

<?php

/* Fonctions utiles */

function str_tronque(string $str, string $debut, string $fin)
{
    $tmp = "";
    $pos = stripos($str, $debut);

    if($pos)
        for($i=$pos ; $i < strlen($str) ; $i++)
            $tmp .= $str[$i];

    $pos = stripos($tmp, $fin);

    $str = "";

    if($pos)
        for($i=0 ; $i < $pos+strlen($fin) ; $i++)
            $str .= $tmp[$i];
    
    return $str;
}

function lidwoord(string $str) : void
{
    $var_01 = str_tronque($str, "<h1>", "</h1>");
    $var_02 = str_tronque($str, "Fran??ais: ", " | ");
    $var_03 = str_tronque($str, "Meervoud: ", "</a><br><strong>");
    $res = strip_tags($var_01 . ' | ' . $var_02 . ' ' . $var_03 . '<br>');
    echo '<h1>'.$res.'</h1>';
}

function werkwoord(string $str) : void
{
    $tijd_01 = "Voltooid deelwoord";
    $tijd_02 = "Onvoltooid tegenwoordige tijd (ott)";
    $tijd_03 = "Voltooid tegenwoordige tijd (vtt)";
    $tijd_04 = "Onvoltooid verleden tijd (ovt)";
    $tijd_05 = "Voltooid verleden tijd (vvt)";
    $tijd_06 = "Onvoltooid tegenwoordige toekomende tijd (ottt)";
    $tijd_07 = "Voltooid tegenwoordige toekomende tijd (vttt)";
    $tijd_08 = "Onvoltooid verleden toekomende tijd (ovtt)";
    $tijd_09 = "Voltooid verleden toekomende tijd (vvtt)";
    $tijd_10 = "Gebiedende wijs";
    $tijd_11 = "Aanvoegende wijs";

    $debut="<tr style=background-color:#666666;color:#ffffff;><td style=padding-left:5px>".$tijd_02;
    $fin="<br><br></td></tr>";

    $str1 = str_tronque($str, $debut, $fin);
    echo '<table>'.$str1.'</table>';

    $debut="<tr style=background-color:#666666;color:#ffffff;><td style=padding-left:5px>".$tijd_03;
    $fin="<br><br></td></tr>";

    $str2 = str_tronque($str, $debut, $fin);
    echo '<table>'.$str2.'</table><br>';
}
?>