<?php

namespace Model;
use Model\Connect;

class ActeurManager {

    public function getActeurs() {

        $pdo = Connect::seConnecter();
        $requeteList = $pdo->prepare(
            "SELECT a.id_acteur, 
                    CONCAT(p.prenom_personne, ' ', UPPER(p.nom_personne)) AS acteur,
                    p.photo_personne AS photo
            FROM acteur a
            LEFT JOIN personne p ON p.id_personne = a.id_personne
            ORDER BY p.nom_personne");

        $requeteList->execute();

        return $requeteList->fetchAll();
    }

    public function getDetActeur($id) {

        $pdo = Connect::seConnecter();
        $requeteDetails = $pdo->prepare(
            "SELECT a.id_acteur,
                    r.id_realisateur, 
                    CONCAT(p.prenom_personne, ' ', UPPER(p.nom_personne)) AS acteur, 
                    DATE_FORMAT(p.date_naissance_personne, '%d %M %Y') AS dateNaissance,
                    DATE_FORMAT(p.date_mort_personne, '%d %M %Y') AS dateMort,
                    DATE_FORMAT(p.date_mort_personne, '%d %M %Y') AS dateAge,
                    genre_personne AS genre,
                    photo_personne AS photo,
                    biographie_personne AS bio
            FROM acteur a  
            LEFT JOIN personne p ON p.id_personne = a.id_personne
            LEFT JOIN realisateur r ON r.id_personne = p.id_personne 
            WHERE a.id_acteur = :id");

        $requeteDetails->execute(["id" => $id]);

        return $requeteDetails->fetch();
    }

    public function getFilmographie($id) {

        $pdo = Connect::seConnecter();
        $requeteFilmographie = $pdo->prepare(
            "SELECT f.id_film, 
                    f.titre_film, 
                    f.affiche_film AS affiche, 
                    YEAR(f.date_sortie_film) AS annee_sortie, 
                    ar.nom_acteur_role AS nomRole
            FROM film f
            LEFT JOIN casting c ON c.id_film = f.id_film
            LEFT JOIN acteur a ON a.id_acteur = c.id_acteur
            LEFT JOIN acteur_role ar ON ar.id_acteur_role = c.id_role
            LEFT JOIN personne p ON p.id_personne = a.id_personne
            WHERE a.id_acteur = :id
            ORDER BY annee_sortie DESC");
        
        $requeteFilmographie->execute(["id" => $id]);

        return $requeteFilmographie->fetchAll();
    }

    public function delActeur($id) {
        $pdo = Connect::seConnecter();
        
        try {
            // Démarrer une transaction
            $pdo->beginTransaction();
            
            // 1. Supprimer d'abord les castings associés
            $requeteCasting = $pdo->prepare(
                "DELETE FROM casting 
                WHERE id_acteur = :id"
            );
            $requeteCasting->execute(["id" => $id]);
            
            // 2. Récupérer l'id_personne de l'acteur
            $requeteGetPersonne = $pdo->prepare(
                "SELECT id_personne 
                FROM acteur 
                WHERE id_acteur = :id"
            );
            $requeteGetPersonne->execute(["id" => $id]);
            $id_personne = $requeteGetPersonne->fetchColumn();
            
            // 3. Supprimer l'acteur
            $requeteActeur = $pdo->prepare(
                "DELETE FROM acteur 
                WHERE id_acteur = :id"
            );
            $requeteActeur->execute(["id" => $id]);
            
            // 4. Supprimer la personne associée
            $requetePersonne = $pdo->prepare(
                "DELETE FROM personne 
                WHERE id_personne = :id_personne"
            );
            $requetePersonne->execute(["id_personne" => $id_personne]);
            
            // Valider la transaction
            $pdo->commit();
            return true;
            
        } catch(PDOException $e) {
            // En cas d'erreur, annuler toutes les modifications
            $pdo->rollBack();
            throw $e;
        }
    }
}