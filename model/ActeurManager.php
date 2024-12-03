<?php

namespace Model;
use Model\Connect;

class ActeurManager {

    public function getActeurs() {

        $pdo = Connect::seConnecter();
        $requeteList = $pdo->prepare(
            "SELECT a.id_acteur, 
                    CONCAT(p.prenom_personne, ' ', UPPER(p.nom_personne)) AS acteurs
            FROM acteur a
            LEFT JOIN personne p ON p.id_personne = a.id_personne
            ORDER BY p.nom_personne");
        $requeteList->execute();

        return $requeteList->fetchAll();
    }

    public function getDetActeurs($id) {

        $pdo = Connect::seConnecter();
        $requeteDetails = $pdo->prepare(
            "SELECT a.id_acteur, 
                    CONCAT(p.prenom_personne, ' ', UPPER(p.nom_personne)) AS acteur, 
                    DATE_FORMAT(p.date_naissance_personne, '%d %M %Y') AS dateNaissance,
                    DATE_FORMAT(p.date_mort_personne, '%d %M %Y') AS dateAge,
                    genre_personne AS genre,
                    photo_personne AS photo,
                    biographie_personne AS bio
            FROM acteur a  
            LEFT JOIN personne p ON p.id_personne = a.id_personne 
            WHERE a.id_acteur = :id");
        $requeteDetails->execute(["id" => $id]);

        return $requeteDetails->fetch();
    }

}