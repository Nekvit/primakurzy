<?php
session_start();

require "seznamstranek.php";

$chyba = null;

//zpracovani prihlaseni
if (array_key_exists("prihlasit", $_POST)) {
    $login = $_POST["loginName"];
    $password = $_POST["password"];
    if ($login == "admin" && $password == "admin") {
        $_SESSION["prihlasen"] = true; 
    }
    else {
        $chyba = "Nesprávné přihlašovací údaje.";
    }
}
// zpracovani odhlaseni
else if(array_key_exists("odhlasit", $_POST)) {
    unset($_SESSION["prihlasen"]);
}

$vybranaStranka = null;
//zjistime ktera stranka je vybrana k editaci
if (array_key_exists("stranka", $_GET)) {
    $idStranky = $_GET["stranka"];
    $vybranaStranka = $seznamStranek[$idStranky];
}

//zpracovani ulozeni
if (array_key_exists("ulozit", $_POST)) {
    $obsah = $_POST["obsah"];
    $vybranaStranka->ulozObsah($obsah);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Document</title>
</head>
<body>

<?php
if (!array_key_exists("prihlasen", $_SESSION)) {
?>   

    <form method="post">
        Login<input type="text" name="loginName">
        <br>
        Heslo<input type="password" name="password">
        <br>
        <button name="prihlasit">Přihlásit</button>
    </form>

    <?php
    if ($chyba != null) {
        echo "<div class='chyba'>$chyba</div>";
    }
}
else {
?>

    <form method="POST">
        <button name="odhlasit">Odhlásit</button>
    </form>
    
<?php
    echo "<ul>";
    foreach ($seznamStranek as $stranka => $udaje) {
        echo "<li><a href='?stranka=$stranka'>$stranka</a></li>";
    }
    echo "</ul>";

    if ($vybranaStranka != null) {
        echo "<h2>Editace Stránky: {$vybranaStranka->getId()} </h2>";
        ?>
        <form method="POST">
            <textarea name="obsah"><?php echo htmlspecialchars($vybranaStranka->getObsah()) ?></textarea>
            <button name="ulozit">Uložit</button>
        </form>

        <?php
    }
}
?>

<script src="lib/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script src="js/admin-tinymce.js"></script>

</script>
</body>
</html>