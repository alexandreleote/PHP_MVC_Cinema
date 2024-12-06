<?php

namespace Model;
use Model\Connect;

class RealisateurManager {

    public function getRealisateurs() {

        $pdo = Connect::seConnecter();
        $requeteList = $pdo->prepare(
            "SELECT r.id_realisateur, 
                    CONCAT(p.prenom_personne, ' ', UPPER(p.nom_personne)) AS realisateur,
                    p.photo_personne AS photo
            FROM realisateur r
            LEFT JOIN personne p ON p.id_personne = r.id_personne
            ORDER BY p.nom_personne ");

        $requeteList->execute();

        return $requeteList->fetchAll();
    }

    public function getDetRealisateur($id) {

        $pdo = Connect::seConnecter();
        $requeteDetails = $pdo->prepare(
            "SELECT r.id_realisateur, 
                    a.id_acteur,
                    CONCAT(p.prenom_personne, ' ', UPPER(p.nom_personne)) AS realisateur, 
                    DATE_FORMAT(p.date_naissance_personne, '%d %M %Y') AS dateNaissance,
                    DATE_FORMAT(p.date_mort_personne, '%d %M %Y') AS dateMort,
                    DATE_FORMAT(p.date_mort_personne, '%d %M %Y') AS dateAge,
                    genre_personne AS genre,
                    photo_personne AS photo,
                    biographie_personne AS bio
            FROM realisateur r
            LEFT JOIN personne p ON p.id_personne = r.id_personne
            LEFT JOIN acteur a ON a.id_personne = p.id_personne
            WHERE r.id_realisateur = :id");
        $requeteDetails->execute(["id" => $id]);

        return $requeteDetails->fetch();
    }

    public function getFilmographie($id) {
        $pdo = Connect::seConnecter();
        $requeteFilmographie = $pdo->prepare(
            "SELECT 
                f.id_film,
                f.titre_film, 
                f.affiche_film AS affiche, 
                YEAR(f.date_sortie_film) AS annee_sortie
            FROM film f
            WHERE f.id_realisateur = :id
            ORDER BY annee_sortie DESC");
        
        $requeteFilmographie->execute(["id" => $id]);
        return $requeteFilmographie->fetchAll();
    }
}