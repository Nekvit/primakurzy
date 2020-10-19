<?php
$db = new PDO(
    "mysql:host=localhost;dbname=penzion;charset=utf8",
    "root", //prihlasovaci jmeno
    "", // heslo
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    )
);

class Stranka {
    protected $id;
    protected $titulek;
    protected $menu;

    function __construct($id, $titulek, $menu){
        $this->id = $id;
        $this->titulek = $titulek;
        $this->menu = $menu;
    }
    
    function getId() {
        return $this->id;
    }
    function getTitulek() {
        return $this->titulek;
    }
    function getMenu() {
        return $this->menu;
    }

    function setId($hodnota) {
        $this->id = $hodnota;
    }
    function setTitulek($hodnota) {
        $this->titulek = $hodnota;
    }
    function setMenu($hodnota) {
        $this->menu = $hodnota;
    }

    function ulozit($oldId) {
        global $db;
        
        // pokud ukladame stranku co uz existuje, tak provadime
		// v databazi update. pokud jde o novou stranku tak
		// volame insert
        if ($oldId != "") {
            
            $dotaz = $db->prepare("UPDATE stranka SET id = ?, titulek = ?, menu = ? WHERE id = ?");
            $dotaz->execute(array($this->id, $this->titulek, $this->menu, $oldId));
        }
        else {

            //zjistime z db kolik je max pocet aby pridana stranka byla na konci
            $dotaz = $db->prepare("SELECT max(poradi) as maximum FROM stranka");
            $dotaz->execute();
            $poradi = $dotaz->fetch()["maximum"] + 1; 

            $dotaz = $db->prepare("INSERT INTO stranka SET id = ?, titulek = ?, menu = ?, obsah = '', poradi = ?");
            $dotaz->execute(array($this->id, $this->titulek, $this->menu, $poradi));
        }
    }

    function getObsah() {

        if ($this->id != "") {
        //Potřebujeme říci, že máme používat globalní proměnnou $db
        //funkce defaultně používají pouze lokální proměnné uvnitř funkce
        global $db;

        //return file_get_contents("$this->id.html");
        $dotaz = $db->prepare("SELECT * from stranka WHERE id = ?");
        $dotaz->execute(array($this->id));

        $vysledek = $dotaz->fetch();

        return $vysledek["obsah"];
        }
        else {
            return "";
        }
    }

    function ulozObsah($obsah) {
        //file_put_contents("$this->id.html", $obsah);

        global $db;

        //return file_get_contents("$this->id.html");
        $dotaz = $db->prepare("UPDATE stranka SET obsah = ? WHERE id = ?");
        $dotaz->execute(array($obsah, $this->id));
        
    }

    function smazSe(){
        global $db;

        $dotaz = $db->prepare("DELETE FROM stranka WHERE id = ?");
        $dotaz->execute(array($this->id));

        //abychom neduplikovali kod muzeme ^toto smazat
        //a zavolat statickou funkci ktera dela to same
        //Stranka::smazatStranku($this->id);
    }

    //nepatří žádné instanci a volá se přes :: místo ->
    static function smazatStranku($idStranky) {
        global $db;

        $dotaz = $db->prepare("DELETE FROM stranka WHERE id = ?");
        $dotaz->execute(array($idStranky));
    }

    static function novePoradi($novePoradi) {
        global $db;

        foreach ($novePoradi as $poradi => $idStranky) {
            $dotaz = $db->prepare("UPDATE stranka SET poradi = ? WHERE id = ?");
            $dotaz->execute(array($poradi, $idStranky));
        }

    }
}

$seznamStranek = array();

$dotaz = $db->prepare("SELECT * FROM stranka ORDER BY poradi");
$dotaz->execute();

$vysledek = $dotaz->fetchAll();

foreach ($vysledek as $radkaTabulkyStranka) {
    $seznamStranek[$radkaTabulkyStranka['id']] = new Stranka($radkaTabulkyStranka['id'], $radkaTabulkyStranka['titulek'], $radkaTabulkyStranka['menu']);
}

/*
$seznamStranek = array(
    "domu" => new Stranka("domu", "Prima Penzion", "Domů"),
    "kontakt" => new Stranka("kontakt", "Kontaktujte nás", "Kontakt"),
    "galerie" => new Stranka("galerie", "Galerie", "Galerie"),
    "rezervace" => new Stranka("rezervace", "Rezervace pokojů", "Rezervace"),
    "404" => new Stranka("404", "404 stránka neexistuje", ""),
);*/

/*
$seznamStranek = array(
    "domu" => array(
        "titulek" => "Prima Penzion",
        "menu" => "Domů",
    ),
    "kontakt" => array(
        "titulek" => "Kontaktujte nás",
        "menu" => "Kontakt",
    ),
    "galerie" => array(
        "titulek" => "Galerie",
        "menu" => "Galerie",
    ),
    "rezervace" => array(
        "titulek" => "Rezervace pokojů",
        "menu" => "Rezervace",
    ),
    "404" => array(
        "titulek" => "404 stránka neexistuje",
        "menu" => "",
    ),
); 
*/