<?php

namespace Model;
use Model\Connect;

class RealisateurManager {

    public function getRealisateurs() {

        $pdo = Connect::seConnecter();
        $requeteList = $pdo->prepare(
            "SELECT r.id_realisateur, 
                    CONCAT(p.prenom_personne, ' ',UPPER(p.nom_personne)) AS realisateur
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
                    CONCAT(p.prenom_personne, ' ', UPPER(p.nom_personne)) AS realisateur, 
                    DATE_FORMAT(p.date_naissance_personne, '%d %M %Y') AS dateNaissance,
                    YEAR(CURDATE()) - YEAR(p.date_naissance_personne) AS age,
                    genre_personne AS genre,
                    photo_personne AS photo,
                    biographie_personne AS bio
            FROM realisateur r
            LEFT JOIN personne p ON p.id_personne = r.id_personne
            WHERE r.id_realisateur = :id");
        $requeteDetails->execute(["id" => $id]);

        return $requeteDetails->fetch();
    }
}