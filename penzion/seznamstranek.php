<?php

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
        return file_get_contents("$this->id.html");
    }

    function ulozObsah($obsah) {
        file_put_contents("$this->id.html", $obsah);
    }
}


$seznamStranek = array(
    "domu" => new Stranka("domu", "Prima Penzion", "Domů"),
    "kontakt" => new Stranka("kontakt", "Kontaktujte nás", "Kontakt"),
    "galerie" => new Stranka("galerie", "Galerie", "Galerie"),
    "rezervace" => new Stranka("rezervace", "Rezervace pokojů", "Rezervace"),
    "404" => new Stranka("404", "404 stránka neexistuje", ""),
);

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