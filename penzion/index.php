<?php
session_start();
use Thunder\Shortcode\Shortcode\Shortcode;

require "lib/shortcode-init.php";
require "seznamstranek.php";

if (array_key_exists("stranka", $_GET)) {
    $aktivniStranka = $_GET["stranka"];
}
else {
    $aktivniStranka = array_key_first($seznamStranek);
}

// potrebujeme zkontrolovat zdali vybrana stranka
// existuje. A pokud neexistuje tak misto toho
// zobrazime nahradni stranku
if (!array_key_exists($aktivniStranka, $seznamStranek)) {
    $aktivniStranka = "404";
    http_response_code(404);
}

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $seznamStranek[$aktivniStranka]->getTitulek(); ?></title>
    <link rel="stylesheet" href="css/style.css?<?php echo filemtime("css/style.css") ?>">
    <link rel="stylesheet" href="css/content.css?<?php echo filemtime("css/content.css") ?>">
    <link rel="stylesheet" href="css/all.min.css?<?php echo filemtime("css/all.min.css") ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js?"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js?"></script>
    
</head>
<body>
    <header>
        <div class="container">

            <div class="headerTop">
                <a href="tel:+420732123456">+420 732 123 456</a>
                <div class="ikony">
                    <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>  
                </div>
            </div>

            <a href="./" class="logo">
                <p>prima</p>
                <p>penzion</p>
            </a>

            <div class="menu">
                <ul>
                    <?php
                    foreach ($seznamStranek as $stranka => $polozka) {
                        if($stranka != "404"){
                            echo "<li><a href='$stranka'>{$polozka->getMenu()}</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>

        </div>
        <div class="headerImg <?php echo $aktivniStranka ?>"></div>
        
    </header>

    <section>
    <?php
    $obsah = $seznamStranek[$aktivniStranka]->getObsah();
    echo ShortcodeProcessor::process($obsah);
    ?>
    </section>

    <footer>
        <div class="paticka">

            <div class="menu">
                <ul>
                    <?php
                    foreach ($seznamStranek as $stranka => $polozka) {
                        if($stranka != "404"){
                            echo "<li><a href='$stranka'>{$polozka->getMenu()}</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>

            <a href="./" class="logo">
                <p>prima</p>
                <p>penzion</p>
            </a>

            <p>
                <i class="fas fa-map-marked-alt"></i>
                <a href="https://goo.gl/maps/NYancbm1wGBs6RSbA" target="_blank">PrimaPenzion, Jablonského 2, Praha 7</a>
            </p>
            <p>
                <i class="fas fa-mobile-alt"></i>
                <a href="tel:+420732123456">+420 732 123 456</a>
            </p>
            <p class="rotate">
                <i class="far fa-envelope" ></i>
                <span>@primapenzion.cz</span>
            </p>
            <div class="ikony">
                <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>  
            </div>

        </div>
    </footer>
    <span id="scrollTop" class="fas fa-chevron-up"></span>
<script>
   
    $("#scrollTop").on("click", () => {
        $("html, body").animate({ scrollTop: 0 }, 1000, "easeInOutQuart");
    })
</script>

<?php
require "lib/photoswipe-init.php";

?>
</body>
</html>