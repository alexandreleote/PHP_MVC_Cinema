<?php

namespace Controller;
use Model\Connect;
use Model\FilmManager;
use Model\RealisateurManager;

class CinemaController {

    private $filmManager;
    private $realisateurManager;

    public function __construct() {
        $this->filmManager = new FilmManager();
        $this->realisateurManager = new RealisateurManager();
    }

    /* Lister les films */
    public function listFilms() {

        $films = $this->filmManager->getFilms();
        
        require "view/film/listFilms.php";
    }

    /* Détails du film */
    public function detFilm($id) {
        
        $film = $this->filmManager->getDetFilm($id);
        $realisateur = $this->filmManager->getRealisateur($id);
        $casting = $this->filmManager->getCasting($id);

        if(!$film) {
            header("Location: index.php");
            exit();
        }

        require "view/film/detailFilm.php";
    }

    /* Modifier un film */
    public function modifyFilm($id) {
        // Récupérer les informations du film
        $modifFilm = $this->filmManager->getDetFilm($id);
        
        // Récupérer le réalisateur du film
        $modifRealisateur = $this->filmManager->getRealisateur($id);
        
        // Récupérer les genres du film
        $requeteGenres = $this->filmManager->getFilmGenres($id);
        
        // Récupérer le casting du film
        $modifCasting = $this->filmManager->getFilmCasting($id);
        
        // Récupérer la liste des réalisateurs
        $realisateurs = $this->realisateurManager->getRealisateurs();
        
        // Récupérer la liste des genres
        $genres = $this->filmManager->getAllGenres();
        
        // Charger la vue de modification de film
        require "view/film/editFilm.php";
    }

    /* Mettre à jour un film */
    public function updateFilm($id) {
        // Sanitize and validate input
        $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sortieFilm = filter_input(INPUT_POST, 'sortieFilm', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $realisateur = filter_input(INPUT_POST, 'newRealisateur', FILTER_VALIDATE_INT);
        $duree = filter_input(INPUT_POST, 'duree', FILTER_VALIDATE_INT);
        $note = filter_input(INPUT_POST, 'note', FILTER_VALIDATE_FLOAT);
        $affiche = filter_input(INPUT_POST, 'affiche', FILTER_SANITIZE_URL);
        $bg = filter_input(INPUT_POST, 'bg', FILTER_SANITIZE_URL);
        $synopsis = filter_input(INPUT_POST, 'synopsis', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Validate required fields
        if (empty($titre) || empty($sortie) || empty($realisateur)) {
            // Use output buffering to prevent header errors
            ob_clean();
            header("Location: index.php?action=modifyFilm&id={$id}&error=missing_fields");
            exit();
        }

        // Sanitize genres
        $genres = filter_input(INPUT_POST, 'genres', FILTER_CALLBACK, [
            'options' => function($value) {
                return is_array($value) ? array_filter($value, 'trim') : [];
            }
        ]) ?? [];

        // Sanitize existing and new actors/roles
        $existingActeurs = filter_input(INPUT_POST, 'existingActeurs', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY) ?? [];
        $existingRoles = filter_input(INPUT_POST, 'existingRoles', FILTER_CALLBACK, [
            'options' => function($value) {
                return is_array($value) ? array_filter($value, 'trim') : [];
            }
        ]) ?? [];
        $newActeur = filter_input(INPUT_POST, 'newActeur', FILTER_VALIDATE_INT);
        $newRole = filter_input(INPUT_POST, 'newRole', FILTER_CALLBACK, ['options' => 'trim']);

        // Mettre à jour les informations du film
        $updateResult = $this->filmManager->updateFilm(
            $id, 
            $titre, 
            $sortie, 
            $realisateur, 
            $duree, 
            $note, 
            $affiche, 
            $bg, 
            $synopsis
        );

        // Mettre à jour les genres
        $updateGenresResult = $this->filmManager->updateFilmGenres($id, $genres);

        // Gérer le casting
        $updateCastingResult = $this->filmManager->updateFilmCasting(
            $id, 
            $existingActeurs, 
            $existingRoles, 
            $newActeur ? [$newActeur] : [], 
            $newRole ? [$newRole] : []
        );

        // Vérifier les résultats
        if ($updateResult && $updateGenresResult && $updateCastingResult) {
            ob_clean();
            header("Location: index.php?action=detFilm&id={$id}&success=update");
            exit();
        } else {
            ob_clean();
            header("Location: index.php?action=modifyFilm&id={$id}&error=update_failed");
            exit();
        }
    }

    /* Supprimer un film */
    public function deleteFilm($id) {
        $deleteResult = $this->filmManager->deleteFilm($id);

        if ($deleteResult) {
            // Rediriger vers la liste des films
            header("Location: index.php?action=listFilms&success=delete");
        } else {
            // Rediriger avec un message d'erreur
            header("Location: index.php?action=detailFilm&id={$id}&error=delete");
        }
        exit();
    }

    /* Supprimer un acteur d'un film */
    public function removeActeurFromFilm($idFilm, $idActeur) {
        // Vérifier si l'ID du film et de l'acteur sont valides
        if (!$idFilm || !$idActeur) {
            header("Location: index.php?action=modifyFilm&id={$idFilm}&error=invalid_parameters");
            exit();
        }

        // Tenter de supprimer l'acteur du film
        $result = $this->filmManager->removeActeurFromFilm($idFilm, $idActeur);

        if ($result) {
            // Redirection en cas de succès
            header("Location: index.php?action=modifyFilm&id={$idFilm}&success=actor_removed");
        } else {
            // Redirection en cas d'erreur
            header("Location: index.php?action=modifyFilm&id={$idFilm}&error=remove_actor_failed");
        }
        exit();
    }
}
