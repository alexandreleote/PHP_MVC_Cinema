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
        $pdo = Connect::seConnecter();
    
        $requeteFilm = $pdo->prepare("SELECT * FROM film WHERE id_film = :id");
        $requeteFilm->execute(['id' => $id]);
        
        $requeteCasting = $pdo->prepare(
            "SELECT CONCAT(p.prenom_personne, ' ', p.nom_personne) AS acteur, ar.nom_acteur_role AS nomRole
            FROM casting c
            LEFT JOIN film f ON f.id_film = c.id_film 
            LEFT JOIN acteur_role ar ON ar.id_acteur_role = c.id_role
            LEFT JOIN acteur a ON a.id_acteur = c.id_acteur
            LEFT JOIN personne p ON p.id_personne = a.id_personne
            WHERE f.id_film = :id");
        $requeteCasting->execute(['id' => $id]);
        
        require "view/film/detailFilm.php";
    }
}
