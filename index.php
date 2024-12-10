<?php

// On appelle les controllers que l'on utilisera sur nos vues    
use Controller\HomeController;
use Controller\CinemaController;
use Controller\ActeurController;
use Controller\RealisateurController;
use Controller\FormController;

// On include les Class des controllers / managers
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

// On déclare nos variables créant nos objets
$ctrlHome = new HomeController();
$ctrlCinema = new CinemaController();
$ctrlActeur = new ActeurController();
$ctrlRealisateur = new RealisateurController();
$ctrlForm = new FormController();

// On vérifie s'il y a bien un id ou non
$id = (isset($_GET["id"])) ? $_GET["id"] : null;

// On vérifie l'action de l'url pour renvoyer la bonne vue
if(isset($_GET["action"])) {
    switch ($_GET["action"]) {
        /* Views Cinema */
        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "detailFilm" : $ctrlCinema->detFilm($id); break;
        case "editFilm" : $ctrlCinema->modifyFilm($id); break;
        case "updateFilm" : $ctrlCinema->updateFilm($id); break;
        case "deleteFilm" : $ctrlCinema->deleteFilm($id); break;
        case "removeActeurFromFilm" : $ctrlCinema->removeActeurFromFilm($id, $_GET['idActeur'] ?? null); break;

        /* Views Acteur */
        case "listActeurs" : $ctrlActeur->listActeurs(); break;
        case "detailActeur" : $ctrlActeur->detActeur($id); break;
        case "editActeur" : $ctrlActeur->modifyActeur($id); break;
        case "updateActeur": $ctrlActeur->updateActeur($id); break;
        case "deleteActeur" : $ctrlActeur->deleteActeur($id); break;
        
        /* Views Realisateur */
        case "listRealisateurs" : $ctrlRealisateur->listRealisateurs(); break;
        case "detailRealisateur" : $ctrlRealisateur->detRealisateur($id); break;
        case "editRealisateur" : $ctrlRealisateur->modifyRealisateur($id); break;

        /* Views Admin */
        case "adminPanel" : $ctrlForm->adminPanel(); break;
        case "addGenre" : $ctrlForm->addGenre(); break;
        case "addFilm" : $ctrlForm->addFilm(); break;

    }
} else { // On renvoie la vue Home par défaut si pas d'action

    $ctrlHome->index(); 
}