<?php
    
use Controller\HomeController;
use Controller\CinemaController;
use Controller\ActeurController;
use Controller\RealisateurController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlHome = new HomeController();
$ctrlCinema = new CinemaController();
$ctrlActeur = new ActeurController();
$ctrlRealisateur = new RealisateurController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])) {
    switch ($_GET["action"]) {

        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "detailFilm" : $ctrlCinema->detFilms($id);break;
        case "listActeurs" : $ctrlActeur->listActeurs(); break;
        case "detailActeur" : $ctrlActeur->detActeur($id); break;
        case "listRealisateurs" : $ctrlRealisateur->listRealisateur(); break;
    }
} else {
    $ctrlHome->index(); 
}