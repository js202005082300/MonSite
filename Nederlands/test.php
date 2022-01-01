<?php

echo '<pre>';
print_r($_SERVER);
echo '</pre>';

if ((substr($_SERVER['REMOTE_ADDR'],0,8) == "192.168.") || ($_SERVER['REMOTE_ADDR'] == "127.0.0.1")) {
    echo 'client is local';
} else {
    echo 'client is not local';
}

class Curl
{
    private $_ch = null;
    private static $certificate = "C:\_Projets\MyWAMP\apache\htdocs\MonSiteProd\cacert.pem";

    public function __construct(string $url)
    {
        $this->_ch = curl_init($url);
        curl_setopt($this->_ch, CURLOPT_CAINFO, self::$certificate);
        curl_setopt($this->_ch, CURLOPT_CAPATH, self::$certificate);
        curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, 1);
    }


}

// http://www.dinduks.com/tutoriel-recuperer-le-contenu-dune-page-web-avec-curl/

if(isset($_POST['woord_woord']) && !empty($_POST['woord_woord']))
{
    
    
    
    //-------------
    
    $ch = curl_init("https://www.mijnwoordenboek.nl/ww.php?woord=".$_POST['woord_woord']);
    $ch_02 = curl_init("https://www.welklidwoord.be/".$_POST['woord_woord']);
    
    options($ch, $ch_02);
    
    $str = curl_exec($ch);
    $str_02 = curl_exec($ch_02);
    
    if(curl_error($ch)) {
        echo '<br>> ' . curl_error($ch) . '<br><br>';
    }
    else
    {    
        $var_01 = str_tronque($str_02, "<h1>", "</h1>");
        $var_02 = str_tronque($str_02, "Français: ", " | ");
        $var_03 = str_tronque($str_02, "Meervoud: ", "</a><br><strong>");
        $res = strip_tags($var_01 . ' | ' . $var_02 . ' ' . $var_03 . '<br>');
        echo '<h1>'.$res.'</h1>';
        
        // $str = str_tronque($str, "<table", "</table>");
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
    
        $str = str_tronque($str, $debut, $fin);
        echo '<table>'.$str.'</table><br>';
    
       // remove_tags("<div>un div.<p>un paragraphe</p></div>", "p", "div");
    }
    
    curl_close($ch);
}

?>
<div>
    <h3>Woordenschat :</h3>
    <div class="woord">
        <form class="woord_form" name="woord_form" action="" method="post">
            <input type="text" class="woord_woord" name="woord_woord" size="55">
            <input type="submit" name="valid_woord" class="valid_woord" value="valider">
        </form>
    </div>
</div>

<div>
    <h3>Bronnen :</h3>
    <p><a href="https://www.mijnwoordenboek.nl/">https://www.mijnwoordenboek.nl/</a></p>
    <p><a href="https://www.welklidwoord.be/">https://www.welklidwoord.be/</a></p>
    <p><a href="https://translate.google.be/?hl=fr&sl=nl&tl=fr&op=translate">NL>FR (translate.google.be)</a></p>
    <p><a href="https://translate.google.be/?hl=fr&sl=fr&tl=nl&op=translate">FR>NL (translate.google.be)</a></p>

</div>


<?php

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

function remove_tags(string $str, ...$tags)
{
    foreach($tags as $tag)
        echo $tag.'<br>';
}

function options(...$ch)
{
    foreach($ch as $el)
    {
        $certificate = "C:\_Projets\MyWAMP\apache\htdocs\MonSiteProd\cacert.pem";
        curl_setopt($el, CURLOPT_CAINFO, $certificate);
        curl_setopt($el, CURLOPT_CAPATH, $certificate);
        curl_setopt($el, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($el, CURLOPT_FILE, $fp);
        // curl_setopt($el, CURLOPT_HEADER, 0);
    }
}
?>