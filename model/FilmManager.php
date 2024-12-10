<?php

namespace Model;
use Model\Connect;

class FilmManager {

    public function getFilms() {

        $pdo = Connect::seConnecter();
        
        $requete = $pdo->prepare(
            "SELECT f.id_film, 
                f.titre_film, 
                f.date_sortie_film AS sortieFilm, 
                f.affiche_film AS affiche,
                TIME_FORMAT(SEC_TO_TIME(f.duree_film * 60), '%H:%i') AS duree,
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
                    f.date_sortie_film AS sortieFilm,
                    f.duree_film AS duree_originale,
                    TIME_FORMAT(SEC_TO_TIME(f.duree_film * 60), '%H:%i') AS duree,
                    f.synopsis_film AS synopsis,
                    f.note_film AS note,
                    f.affiche_film AS affiche,
                    f.ba_film AS ba,
                    f.bg_film AS bg,
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

    public function getFilmCasting($id) {
        $pdo = Connect::seConnecter();
        
        $requeteCasting = $pdo->prepare(
            "SELECT 
                c.id_acteur,
                p.id_personne,
                ar.nom_acteur_role AS role,
                p.prenom_personne,
                p.nom_personne,
                p.photo_personne
            FROM casting c
            INNER JOIN acteur a ON c.id_acteur = a.id_acteur
            INNER JOIN personne p ON a.id_personne = p.id_personne
            INNER JOIN acteur_role ar ON c.id_role = ar.id_acteur_role
            WHERE c.id_film = :id
            ORDER BY ar.nom_acteur_role"
        );
        $requeteCasting->execute(['id' => $id]);
        
        return $requeteCasting->fetchAll();
    }

    public function getAllGenres() {
        $pdo = Connect::seConnecter();
        $requeteGenres = $pdo->prepare("SELECT id_genre, nom_genre FROM genre ORDER BY nom_genre");
        $requeteGenres->execute();
        
        return $requeteGenres->fetchAll();
    }

    public function getFilmGenres($idFilm) {
        $pdo = Connect::seConnecter();
        
        $requeteGenres = $pdo->prepare(
            "SELECT g.id_genre, g.nom_genre
            FROM genre g
            INNER JOIN film_genre fg ON fg.id_genre = g.id_genre
            WHERE fg.id_film = :idFilm
            ORDER BY g.nom_genre"
        );
        $requeteGenres->execute(['idFilm' => $idFilm]);
        
        return $requeteGenres->fetchAll();
    }

    public function updateFilm($id, $titre, $sortie, $realisateur, $duree, $note, $affiche, $bg, $synopsis) {
        $pdo = Connect::seConnecter();

        try {
            $pdo->beginTransaction();

            // Mettre à jour les informations du film
            $requete = $pdo->prepare("
                UPDATE film 
                SET 
                    titre_film = :titre, 
                    date_sortie_film = :sortie, 
                    id_realisateur = :realisateur,
                    duree_film = :duree,
                    note_film = :note,
                    affiche_film = :affiche,
                    bg_film = :bg,
                    synopsis_film = :synopsis
                WHERE id_film = :id
            ");

            $requete->execute([
                'titre' => $titre,
                'sortie' => $sortie,
                'realisateur' => $realisateur,
                'duree' => $duree,
                'note' => $note,
                'affiche' => $affiche,
                'bg' => $bg,
                'synopsis' => $synopsis,
                'id' => $id
            ]);

            $pdo->commit();
            return true;
        } catch (\PDOException $e) {
            $pdo->rollBack();
            return false;
        }
    }

    public function updateFilmGenres($id, $genres) {
        $pdo = Connect::seConnecter();

        try {
            $pdo->beginTransaction();

            // Supprimer les anciens genres
            $deleteGenres = $pdo->prepare("DELETE FROM film_genre WHERE id_film = :id");
            $deleteGenres->execute(['id' => $id]);

            // Filtrer et nettoyer les genres
            $cleanGenres = array_filter(is_array($genres) ? $genres : [], function($genre) {
                return is_string($genre) && trim($genre) !== '';
            });

            // Ajouter les nouveaux genres
            if (!empty($cleanGenres)) {
                $insertGenre = $pdo->prepare("
                    INSERT INTO film_genre (id_film, id_genre) 
                    SELECT :id, id_genre FROM genre WHERE nom_genre = :genre
                ");

                foreach ($cleanGenres as $genre) {
                    $insertGenre->execute(['id' => $id, 'genre' => trim($genre)]);
                }
            }

            $pdo->commit();
            return true;
        } catch (\PDOException $e) {
            $pdo->rollBack();
            error_log("Erreur lors de la mise à jour des genres : " . $e->getMessage());
            return false;
        }
    }

    public function updateFilmCasting($id, $existingActeurs, $existingRoles, $newActeurs, $newRoles) {
        $pdo = Connect::seConnecter();
        
        try {
            $pdo->beginTransaction();

            // Supprimer les anciens rôles
            $deleteRoles = $pdo->prepare("DELETE FROM casting WHERE id_film = :id");
            $deleteRoles->execute(['id' => $id]);

            // Nettoyer et valider les acteurs et rôles existants
            $cleanExistingActeurs = array_filter(is_array($existingActeurs) ? $existingActeurs : [], 'is_numeric');
            $cleanExistingRoles = array_filter(is_array($existingRoles) ? $existingRoles : [], function($role) {
                return is_string($role) && trim($role) !== '';
            });

            // Ajouter les rôles existants
            if (!empty($cleanExistingActeurs) && !empty($cleanExistingRoles)) {
                // Limiter aux tableaux de même longueur
                $maxIndex = min(count($cleanExistingActeurs), count($cleanExistingRoles));
                
                // D'abord récupérer les id_role correspondant aux rôles
                $getRoleId = $pdo->prepare("SELECT id_acteur_role FROM acteur_role WHERE nom_acteur_role = :role");
                
                $insertRole = $pdo->prepare("
                    INSERT INTO casting (id_film, id_acteur, id_role) 
                    VALUES (:id_film, :id_acteur, :id_role)
                ");

                for ($i = 0; $i < $maxIndex; $i++) {
                    // Récupérer l'id_role pour le rôle
                    $getRoleId->execute(['role' => $cleanExistingRoles[$i]]);
                    $roleResult = $getRoleId->fetch();
                    
                    if ($roleResult) {
                        $insertRole->execute([
                            'id_film' => $id,
                            'id_acteur' => $cleanExistingActeurs[$i],
                            'id_role' => $roleResult['id_acteur_role']
                        ]);
                    }
                }
            }

            // Nettoyer et valider les nouveaux acteurs et rôles
            $cleanNewActeurs = array_filter(is_array($newActeurs) ? $newActeurs : [], 'is_numeric');
            $cleanNewRoles = array_filter(is_array($newRoles) ? $newRoles : [], function($role) {
                return is_string($role) && trim($role) !== '';
            });

            // Ajouter les nouveaux rôles
            if (!empty($cleanNewActeurs) && !empty($cleanNewRoles)) {
                // Limiter aux tableaux de même longueur
                $maxIndex = min(count($cleanNewActeurs), count($cleanNewRoles));
                
                // D'abord récupérer les id_role correspondant aux rôles
                $getRoleId = $pdo->prepare("SELECT id_acteur_role FROM acteur_role WHERE nom_acteur_role = :role");
                
                $insertRole = $pdo->prepare("
                    INSERT INTO casting (id_film, id_acteur, id_role) 
                    VALUES (:id_film, :id_acteur, :id_role)
                ");

                for ($i = 0; $i < $maxIndex; $i++) {
                    // Récupérer l'id_role pour le rôle
                    $getRoleId->execute(['role' => $cleanNewRoles[$i]]);
                    $roleResult = $getRoleId->fetch();
                    
                    if ($roleResult) {
                        $insertRole->execute([
                            'id_film' => $id,
                            'id_acteur' => $cleanNewActeurs[$i],
                            'id_role' => $roleResult['id_acteur_role']
                        ]);
                    }
                }
            }

            $pdo->commit();
            return true;
        } catch (\PDOException $e) {
            $pdo->rollBack();
            error_log("Erreur lors de la mise à jour du casting : " . $e->getMessage());
            return false;
        }
    }

    public function deleteFilm($id) {
        $pdo = Connect::seConnecter();
        
        try {
            $pdo->beginTransaction();

            // Supprimer les genres du film
            $deleteGenres = $pdo->prepare("DELETE FROM film_genre WHERE id_film = :id");
            $deleteGenres->execute(['id' => $id]);

            // Supprimer les associations d'acteurs
            $deleteActeurs = $pdo->prepare("DELETE FROM casting WHERE id_film = :id");
            $deleteActeurs->execute(['id' => $id]);

            // Supprimer le film
            $deleteFilm = $pdo->prepare("DELETE FROM film WHERE id_film = :id");
            $deleteFilm->execute(['id' => $id]);

            $pdo->commit();
            return true;
        } catch (\PDOException $e) {
            $pdo->rollBack();
            error_log("Erreur lors de la suppression du film : " . $e->getMessage());
            return false;
        }
    }

    public function removeActeurFromFilm($idFilm, $idActeur) {
        $pdo = Connect::seConnecter();
        
        try {
            // Begin transaction
            $pdo->beginTransaction();
            
            // Prepare and execute delete query
            $requeteDelete = $pdo->prepare(
                "DELETE FROM casting 
                WHERE id_film = :idFilm AND id_acteur = :idActeur"
            );
            $requeteDelete->execute([
                'idFilm' => $idFilm,
                'idActeur' => $idActeur
            ]);
            
            // Commit transaction
            $pdo->commit();
            
            return true;
        } catch (\PDOException $e) {
            // Rollback transaction in case of error
            $pdo->rollBack();
            
            // Log or handle the error
            error_log("Erreur lors de la suppression de l'acteur du film : " . $e->getMessage());
            
            return false;
        }
    }
}