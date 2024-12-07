<?php

namespace Model;
use Model\Connect;

class HomeManager {

    public function getFeaturedFilm() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare(
            "SELECT f.id_film,
                    f.titre_film,
                    YEAR(f.date_sortie_film) AS annee_sortie,
                    TIME_FORMAT(SEC_TO_TIME(f.duree_film * 60), '%H:%i') AS duree,
                    f.synopsis_film AS synopsis,
                    f.ba_film AS ba,
                    GROUP_CONCAT(g.nom_genre SEPARATOR ' / ') AS genre,
                    r.id_realisateur,
                    CONCAT(p.prenom_personne, ' ', p.nom_personne) AS realisateur
            FROM film f
            LEFT JOIN film_genre fg ON fg.id_film = f.id_film
            LEFT JOIN genre g ON g.id_genre = fg.id_genre
            LEFT JOIN realisateur r ON r.id_realisateur = f.id_realisateur
            LEFT JOIN personne p ON p.id_personne = r.id_personne
            WHERE f.date_sortie_film <= CURDATE()
            GROUP BY f.id_film
            ORDER BY f.date_sortie_film DESC
            LIMIT 1");
        $requete->execute();
        
        return $requete->fetch();
    }   
}