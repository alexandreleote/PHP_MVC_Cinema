<?php

namespace Controller;
// use Model\Connect;
use Model\FilmManager;

class CinemaController {

    /**
     * Lister les films
     */
    public function listFilms() {

        $filmManager = new FilmManager();
        $films = $filmManager->getFilms();
        
        require "view/film/listFilms.php";
    }

    /** 
     * Détail du film
     */
    public function detFilms($id) {
        
        $filmManager = new FilmManager();
        $details = $filmManager->getDetails($id);
        $realisateur = $filmManager->getRealisateur($id);
        $casting = $filmManager->getCasting($id);

        require "view/film/detailFilm.php";
    }
}
