<?php

namespace Model;
use Model\Connect;

class FormManager {
    
    public function addGenre($nomGenre) {
        $pdo = Connect::seConnecter();
        
        $requeteGenre = $pdo->prepare(
            "INSERT INTO genre (nom_genre)
            VALUES (:nomGenre)");
        $requeteGenre->execute(['nomGenre' => $nomGenre]);
        
        return true;
    }
    
    public function getAllGenres() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query(
            "SELECT id_genre,
                    nom_genre
            FROM genre
            ORDER BY nom_genre");
        return $requete->fetchAll();
    }

    public function getAllRealisateurs() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query(
            "SELECT id_realisateur,
                    CONCAT(prenom_personne, ' ', nom_personne) AS nom
            FROM realisateur
            LEFT JOIN personne ON personne.id_personne = realisateur.id_personne
            ORDER BY nom");
        return $requete->fetchAll();
    }

}