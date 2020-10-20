<?php
require 'lib/PHPMailer-master/src/Exception.php';
require 'lib/PHPMailer-master/src/PHPMailer.php';
require 'lib/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$jmeno = null;
$prijmeni = null;
$mail = null;
$vzkaz = null;
$chyby = array();
$uspesneOdeslano = false;

if (array_key_exists("odeslat", $_POST)) {
    $jmeno = trim($_POST["jmeno"]); // trim() odebira vsechny bile znaky ze zacatku a z konce
    $prijmeni = trim($_POST["prijmeni"]);
    $mail = trim($_POST["mail"]);
    $vzkaz = trim($_POST["vzkaz"]);

    //validace
    if ($jmeno == "") {
        $chyby["jmeno"] = "Jméno musí být vyplněno.";
    }

    if ($prijmeni == "") {
        $chyby["prijmeni"] = "Příjmení musí být vyplněno.";
    }

    if ($mail == "") {
        $chyby["mail"] = "Email musí být vyplněn.";
    }

    if ($vzkaz == "") {
        $chyby["vzkaz"] = "Vzkaz musí být vyplněn.";
    }

    //pokud nenastala chyba odesleme email
    if (count($chyby) == 0) {

        $uspesneOdeslano = true;

        $mailer = new PHPMailer(true);

        try {
            $mailer->CharSet = "utf-8";
            
            //Server settings
            $mailer->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
            $mailer->isSMTP();                                            // Send using SMTP
            $mailer->Host       = 'primakurzy.cz.smtp.primawebhosting.cz';   // Set the SMTP server to send through
            $mailer->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mailer->Username   = 'student@primakurzy.cz';                     // SMTP username
            $mailer->Password   = 'kurzyjsouprima';                               // SMTP password
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mailer->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mailer->setFrom('student@kurzy.cz', 'student');
            $mailer->addAddress('vitnekolny@gmail.com', 'Vit');     // Add a recipient

            // Přílohy
            //$mailer->addAttachment('kocka.jpg');         // Add attachments

            // Content
            $mailer->isHTML(true);                                  // Set email format to HTML
            $mailer->Subject = 'Kontaktní formulář';
            $mailer->Body    = "
            <b>Jméno:</b> $jmeno <br>
            <b>Příjmení:</b> $prijmeni <br>
            <b>E-mail:</b> $mail <br>
            <b>Vzkaz:</b> $vzkaz <br>
            ";
            $mailer->AltBody = ''; //pokud mailer naumi html tagy

            $mailer->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
        }
    
    }


}

?>

<div class="kontaktBox" id="kontaktBox">


        <h2>Napište nám</h2>
            <?php 
            if (count($chyby) != 0) {
                echo "<h3>Formulář obsahuje chyby.</h3>";
                echo "<ul class='chyby'>";
                foreach ($chyby as $chyba) {
                    echo "<li>$chyba</li>";
                }
                echo "</ul>";
            }
        if($uspesneOdeslano == false) {

        
            ?>
            <form action="#kontaktBox" method="POST" class="formular" >
                <input type="text" name="jmeno" placeholder="Jméno" value="<?php echo htmlspecialchars($jmeno); ?>" /> 
                <input type="text" name="prijmeni" placeholder="Příjmení" value="<?php echo htmlspecialchars($prijmeni);?>" /> 
                <input type="text" name="mail" placeholder="Email" value="<?php echo htmlspecialchars($mail); ?>" /> 
                <textarea name="vzkaz" rows="10" placeholder="Napište nám.."><?php echo htmlspecialchars($vzkaz); ?></textarea> 
                <input class="button" name="odeslat" type="submit" value="ODEŠLI" />
            </form>
            <?php
        }
        else {
            echo "<h2 class='uspech fas fa-check'> Vzkaz byl úspěšně odeslán.</h2>";
            echo "
                <form action='#kontaktBox' method='post'>
                <button>Odeslat nový formulář</button>
                </form> ";
        }
        ?>

</div>

