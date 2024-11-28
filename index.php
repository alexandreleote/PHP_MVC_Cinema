<?php
    
use Controller\CinemaController;
use Controller\ActeurController;
use Controller\HomeController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlHome = new HomeController();
$ctrlCinema = new CinemaController();
$ctrlActeur = new ActeurController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])) {
    switch ($_GET["action"]) {

        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
        case "detailActeur" : $ctrlActeur->detActeur($id); break;
    }
} else {
    $ctrlHome->index(); 
}