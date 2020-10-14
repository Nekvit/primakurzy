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

    function getObsah() {
        //Potřebujeme říci, že máme používat globalní proměnnou $db
        //funkce defaultně používají pouze lokální proměnné uvnitř funkce
        global $db;

        //return file_get_contents("$this->id.html");
        $dotaz = $db->prepare("SELECT * from stranka WHERE id = ?");
        $dotaz->execute(array($this->id));

        $vysledek = $dotaz->fetch();

        return $vysledek["obsah"];
    }

    function ulozObsah($obsah) {
        //file_put_contents("$this->id.html", $obsah);

        global $db;

        //return file_get_contents("$this->id.html");
        $dotaz = $db->prepare("UPDATE stranka SET obsah = ? WHERE id = ?");
        $dotaz->execute(array($obsah, $this->id));
        
    }
}

$seznamStranek = array();

$dotaz = $db->prepare("SELECT * FROM stranka");
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