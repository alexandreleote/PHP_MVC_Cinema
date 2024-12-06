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
            "SELECT r.id_realisateur, 
                    CONCAT(p.prenom_personne, ' ', p.nom_personne) AS realisateur
            FROM realisateur r
            LEFT JOIN personne p ON p.id_personne = r.id_personne
            ORDER BY realisateur");
        return $requete->fetchAll();
    }

    public function addFilm($titre, $affiche, $note, $duree, $realisateur, $dateSortie, $synopsis, $genresFilm) {
        $pdo = Connect::seConnecter();
        
        // Insertion du film
        $requete = $pdo->prepare(
            "INSERT INTO film (titre_film, affiche_film, note_film, duree_film, id_realisateur, date_sortie_film, synopsis_film)
            VALUES (:titre, :affiche, :note, :duree, :realisateur, :dateSortie, :synopsis)"
        );
        
        $requete->execute([
            ':titre' => $titre,
            ':affiche' => $affiche,
            ':note' => $note,
            ':duree' => $duree,
            ':realisateur' => $realisateur,
            ':dateSortie' => $dateSortie,
            ':synopsis' => $synopsis
        ]);

        // Récupération de l'id du film inséré
        $idFilm = $pdo->lastInsertId();

        // Insertion des genres du film
        $requeteGenres = $pdo->prepare("INSERT INTO film_genre (id_film, id_genre) VALUES (:idFilm, :idGenre)");
        
        foreach ($genresFilm as $idGenre) {
            $requeteGenres->execute([
                ':idFilm' => $idFilm,
                ':idGenre' => $idGenre
            ]);
        }
    }

}