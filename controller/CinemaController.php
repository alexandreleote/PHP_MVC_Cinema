<?php

namespace Controller;
use Model\Connect;

class CinemaController {

    /**
     * Lister les films
     */
    public function listFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre_film, date_sortie_film
            FROM film
        ");

        require "view/film/listFilms.php";
    }
}
