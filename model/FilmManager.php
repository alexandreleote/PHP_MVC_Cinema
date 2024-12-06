<?php

namespace Model;
use Model\Connect;

class FilmManager {

    public function getFilms() {

        $pdo = Connect::seConnecter();
        
        $requete = $pdo->prepare(
            "SELECT f.id_film, f.titre_film, 
                f.date_sortie_film AS sortieFilm, 
                f.affiche_film AS affiche,
                f.id_film
            FROM film f
            ORDER BY sortieFilm DESC");
        $requete->execute();

        return $requete->fetchAll();
    }

    public function getDetFilm($id) {

        $pdo = Connect::seConnecter();
        
        $requeteFilm = $pdo->prepare(
            "SELECT f.id_film, 
                    f.titre_film, 
                    YEAR(f.date_sortie_film) AS annee_sortie,
                    TIME_FORMAT(SEC_TO_TIME(f.duree_film * 60), '%H:%i') AS duree,
                    f.synopsis_film AS synopsis,
                    f.note_film,
                    f.affiche_film AS affiche,
                    f.bg_film AS background,
                    GROUP_CONCAT(g.nom_genre SEPARATOR ' / ') AS genre
            FROM film f
            LEFT JOIN film_genre fg ON fg.id_film = f.id_film
            LEFT JOIN genre g ON g.id_genre = fg.id_genre
            WHERE f.id_film = :id");
        $requeteFilm->execute(['id' => $id]);
        
        return $requeteFilm->fetch();
    }

    public function getRealisateur($id) {

        $pdo = Connect::seConnecter();

        $requeteRealisateur = $pdo->prepare(
            "SELECT r.id_realisateur, 
                    CONCAT(p.prenom_personne, ' ', UPPER(p.nom_personne)) AS realisateur,
                    p.photo_personne AS photo
            FROM realisateur r
            LEFT JOIN personne p ON p.id_personne = r.id_personne
            LEFT JOIN film f ON f.id_realisateur = r.id_realisateur
            WHERE f.id_film = :id");
        $requeteRealisateur->execute(['id' => $id]);

        return $requeteRealisateur->fetchAll();
    }
    
    public function getCasting($id) {

        $pdo = Connect::seConnecter();
        $requeteCasting = $pdo->prepare(
            "SELECT a.id_acteur, 
                    CONCAT(p.prenom_personne, ' ', UPPER(p.nom_personne)) AS acteur, 
                    UPPER(ar.nom_acteur_role) AS nomRole,
                    p.photo_personne AS photo
            FROM casting c
            LEFT JOIN film f ON f.id_film = c.id_film 
            LEFT JOIN acteur_role ar ON ar.id_acteur_role = c.id_role
            LEFT JOIN acteur a ON a.id_acteur = c.id_acteur
            LEFT JOIN personne p ON p.id_personne = a.id_personne
            WHERE f.id_film = :id");
        $requeteCasting->execute(['id' => $id]);
        
        return $requeteCasting->fetchAll();
    }
}