<?php

namespace Model;
use Model\Connect;

class CompteManager {
    
    public function selectMovie() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare(
            "SELECT f.id_film, f.titre_film, YEAR(f.date_sortie_film) AS annee_sortie, f.date_sortie_film, id_film
            FROM film f
            ORDER BY annee_sortie DESC");
        $requete->execute();

        return $requete->fetchAll();
    } 
    
    public function modifyMovie($id) {
        $pdo = Connect::seConnecter();
        $requeteFilm = $pdo->prepare(
            "SELECT f.id_film, 
                    f.titre_film, 
                    YEAR(f.date_sortie_film) AS annee_sortie,
                    TIME_FORMAT(SEC_TO_TIME(f.duree_film * 60), '%H:%i') AS duree,
                    f.synopsis_film AS synopsis,
                    f.note_film,
                    f.affiche_film AS affiche
            FROM film f
            WHERE f.id_film = :id");
        $requeteFilm->execute(['id' => $id]);
        
        return $requeteFilm->fetch();
    }
}