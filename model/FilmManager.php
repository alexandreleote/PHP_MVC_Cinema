<?php

namespace Model;
use Model\Connect;

class FilmManager {

    public function getFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre_film, YEAR(date_sortie_film) AS annee_sortie, id_film
            FROM film
            ORDER BY annee_sortie DESC
        ");

        return $requete->fetchAll();
    }
}