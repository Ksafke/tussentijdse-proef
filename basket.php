<?php
// altijd eerst de require_once voor de session_start() !! anders worden de klassen niet goed geladen.
require_once('includes/Winkelmand.php');
session_start();

$items[] = array('id' => 1,
               'titel' => "GSM 1",
                'aantal' => 1,
                'prijs' => 10);
$items[] = array('id' => 2,
               'titel' => "GSM 2",
                'aantal' => 1,
                'prijs' => 10);
$items[] = array('id' => 3,
               'titel' => "GSM 3",
                'aantal' => 1,
                'prijs' => 10);
$items[] = array('id' => 4,
               'titel' => "GSM 4",
                'aantal' => 1,
                'prijs' => 10);
$items[] = array('id' => 5,
               'titel' => "GSM 5",
                'aantal' => 1,
                'prijs' => 10);
$items[] = array('id' => 6,
               'titel' => "GSM 6",
                'aantal' => 1,
                'prijs' => 10);
$items[] = array('id' => 7,
               'titel' => "GSM 7",
                'aantal' => 1,
                'prijs' => 10);
$items[] = array('id' => 8,
               'titel' => "GSM 8",
                'aantal' => 1,
                'prijs' => 10);
$items[] = array('id' => 1,
               'titel' => "GSM 9",
                'aantal' => 1,
                'prijs' => 10);
$items[] = array('id' => 9,
               'titel' => "GSM 1",
                'aantal' => 1,
                'prijs' => 10);

if($_GET['type'] === 'add') {
    if(!isset($_SESSION['winkelmand'])){
        $_SESSION['winkelmand'] = new Winkelmand();
    }
    
    foreach ($items as $item) {
        if ((int)$item['id'] === (int)$_GET['product']) {
            $product = $item;
            break;
        }
    }

    $_SESSION['winkelmand']->toevoegenAanMand($product);
   
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Tussentijdse proef</title>
        <link rel="stylesheet" href="style.css" />
    </head>    
    <body>
        <div id="container">
            <header>
                <div id="logo">
                    
                </div>
                <div id="currency">
                    
                </div>
            </header>
            <nav class="top">
            </nav>
            <section id="sectionTeaser">
                <div id="teaser">
                    
                </div>
                <div id="login">
                    
                </div>
            </section>
            <section id="content">
                <div id="sectionLeft">
                    <h1>winkelmand</h1>
                    <?php
                    $cartContent = '<ul>';

                    $totaalAantal = 0;
                    $totaalPrijs  = 0;
                    foreach ($_SESSION['winkelmand']->mandWeergeven() as $it) { 

                        $totaalAantal += $it['aantal'];
                        $totaalPrijs  += ($it['prijs'] * $it['aantal']);

                        $cartContent .=  '<li>product: '. $it['titel'] .' - aantal: '. $it['aantal'] .' - prijs: '. $it['prijs'] .'&euro; - subtotaal: '. ($it['aantal'] * $it['prijs']) .'&euro;</li>';


                    } 
                    $cartContent .= '</ul>';
                    $cartContent .=  '<hr /><p>De totale prijs voor '.$totaalAantal .' stuk(s) is '. $totaalPrijs .' &euro; </p>';
                    
                    echo $cartContent; 
                    ?>
                    
                    <h1>Bestellen</h1>
                    
                    <?php
                    if (isset($_POST['email'])) {
                        
                        
                        $to      = $_POST['email'];
                        $subject = "Nieuwe bestelling op Springsale";
                        
                        $message = $cartContent;
                        
                        $headers = 'From: Sprinsale <springsale@example.com>' . "\n";
                        $headers .= 'MIME-Version: 1.0' . "\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
                        
                        if(mail($to, $subject, $message, $headers)){
                            unset($_SESSION['winkelmand']);
                        }
                        
                    ?>
                    <p>Uw bestelling werd geplaatst, uw wordt zo dadelijk doorgestuurd naar de home pagina</a>
                    <?php
                    header('refresh: 5; url=/tussentijdseproef');
                    ?>
                    <?php }else{ ?>
                    <form method="POST" action="#">
                        <input type="text" name="email" value="Vul uw E-mail in" /><br />
                        <input type="submit" value="Bestel" />
                    </form>
                    <?php } ?>  
 
                </div>
                <div id="sectionRightTop">
                    <h1 class="hidden">Browse departments</h1>
                </div>
                <div id="sectionRightBottom">
                    <article>
                        <h1 class="hidden">Daily Specials <a href="">View more</a></h1>
                        <img src="" alt="" /> 
                        <aside>
                                <div class="price"></div>
                                <button></button>
                        </aside>
                    </article>
                </div>
            </section>
            <footer>
                <p>All rights reserved. &copy; copyright 2012 - Syntra West.</p>
            </footer>
        </div>
    </body>
</html>