<?php

// On appelle les controllers que l'on utilisera sur nos vues    
use Controller\HomeController;
use Controller\CinemaController;
use Controller\ActeurController;
use Controller\RealisateurController;

// On include les Class des controllers / managers
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

// On déclare nos variables créant nos objets
$ctrlHome = new HomeController();
$ctrlCinema = new CinemaController();
$ctrlActeur = new ActeurController();
$ctrlRealisateur = new RealisateurController();

// On vérifie s'il y a bien un id ou non
$id = (isset($_GET["id"])) ? $_GET["id"] : null;

// On vérifie l'action de l'url pour renvoyer la bonne vue
if(isset($_GET["action"])) {
    switch ($_GET["action"]) {

        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "detailFilm" : $ctrlCinema->detFilm($id);break;

        case "listActeurs" : $ctrlActeur->listActeurs(); break;
        case "detailActeur" : $ctrlActeur->detActeur($id); break;
        
        case "listRealisateurs" : $ctrlRealisateur->listRealisateurs(); break;
        case "detailRealisateur" : $ctrlRealisateur->detRealisateur($id); break;

    }
} else { // On renvoie la vue Home par défaut si pas d'action

    $ctrlHome->index(); 
} 