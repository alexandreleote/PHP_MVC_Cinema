<?php

namespace Model;
use Model\Connect;

class ActeurManager {

    /* Récupérer la liste des acteurs */
    public function getActeurs() {

        $pdo = Connect::seConnecter();
        $requeteList = $pdo->prepare(
            "SELECT 
                p.id_personne AS id_acteur, 
                p.prenom_personne,
                p.nom_personne,
                p.photo_personne AS photo_acteur,
                p.date_naissance_personne AS dateNaissance
            FROM personne p
            INNER JOIN acteur a ON a.id_personne = p.id_personne
            ORDER BY p.nom_personne");

        $requeteList->execute();

        return $requeteList->fetchAll();
    }

    /* Récupérer les details de l'acteur */
    public function getDetActeur($id) {

        $pdo = Connect::seConnecter();
        $requeteDetails = $pdo->prepare(
            "SELECT a.id_acteur, 
                    r.id_realisateur,
                    p.prenom_personne,
                    p.nom_personne,
                    CONCAT(p.prenom_personne, ' ', UPPER(p.nom_personne)) AS acteur, 
                    DATE_FORMAT(p.date_naissance_personne, '%d %M %Y') AS dateNaissance,
                    DATE_FORMAT(p.date_mort_personne, '%d %M %Y') AS dateMort,
                    genre_personne AS genre,
                    photo_personne AS photo,
                    bg_personne AS bg,
                    biographie_personne AS bio
            FROM acteur a
            LEFT JOIN personne p ON p.id_personne = a.id_personne
            LEFT JOIN realisateur r ON r.id_personne = p.id_personne
            WHERE a.id_acteur = :id");
        $requeteDetails->execute(["id" => $id]);

        return $requeteDetails->fetch();
    }

    /* Récupérer la filmographie de l'acteur */
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

    /* Mettre à jour un acteur */
    public function updateActeur($id, $data) {
        $pdo = Connect::seConnecter();
        
        $pdo->beginTransaction();
        
        // Mise à jour des informations de la personne
        $requeteUpdatePersonne = $pdo->prepare(
            "UPDATE personne p
            INNER JOIN acteur a     ON a.id_personne = p.id_personne
            SET p.nom_personne = COALESCE(:nom, p.nom_personne),
                p.prenom_personne = COALESCE(:prenom, p.prenom_personne),
                p.genre_personne = COALESCE(:genre, p.genre_personne),
                p.date_naissance_personne = COALESCE(:dateNaissance, p.date_naissance_personne),
                p.date_mort_personne = COALESCE(:dateMort, p.date_mort_personne),
                p.photo_personne = COALESCE(:photo, p.photo_personne),
                p.bg_personne = COALESCE(:bg, p.bg_personne),
                p.biographie_personne = COALESCE(:bio, p.biographie_personne)
            WHERE a.id_acteur = :id"
        );
        
        // Convertir les dates vides en NULL
        $dateNaissance = !empty($data['dateNaissance']) ? $data['dateNaissance'] : null;
        $dateMort = !empty($data['dateMort']) ? $data['dateMort'] : null;
        
        $requeteUpdatePersonne->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'genre' => $data['genre'],
            'dateNaissance' => $dateNaissance,
            'dateMort' => $dateMort,
            'photo' => $data['photo'],
            'bg' => $data['bg'],
            'bio' => $data['bio'],
            'id' => $id
        ]);
        
        // Récupérer l'id_personne
        $requeteIdPersonne = $pdo->prepare(
            "SELECT p.id_personne 
            FROM acteur a
            INNER JOIN personne p ON p.id_personne = a.id_personne
            WHERE a.id_acteur = :id"
        );
        $requeteIdPersonne->execute(['id' => $id]);
        $idPersonne = $requeteIdPersonne->fetchColumn();
        
        // Gérer les métiers
        // Supprimer les anciens rôles
        $pdo->prepare("DELETE FROM realisateur WHERE id_personne = ?")->execute([$idPersonne]);
        
        // Ajouter les nouveaux rôles
        if (isset($data['metiers']) && is_array($data['metiers'])) {
            foreach ($data['metiers'] as $metier) {
                if ($metier === 'realisateur') {
                    $pdo->prepare("INSERT INTO realisateur (id_personne) VALUES (?)")->execute([$idPersonne]);
                }
            }
        }
        
        $pdo->commit();
        return true;
    }

    /* Supprimer un acteur */
    public function delActeur($id) {
        $pdo = Connect::seConnecter();
        
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
    }
}