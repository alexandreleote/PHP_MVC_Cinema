<?php

namespace Controller;
use Model\CompteManager;
use Model\FormManager;

class FormController {
    
    public function adminPanel() {
        $formManager = new FormManager();
        
        $genres = $formManager->getAllGenres();
        
        require "view/admin/adminPanel.php";
    }
    
    public function addGenre() {
        if (isset($_POST["nomGenre"])) {
            $formManager = new FormManager();
            $nomGenre = filter_input(INPUT_POST, "nomGenre", FILTER_SANITIZE_SPECIAL_CHARS);
            
            if ($nomGenre) {
                $formManager->addGenre($nomGenre);
            }
        }

        $formManager = new FormManager();
        $genres = $formManager->getAllGenres();

        require "view/admin/addGenre.php";
    }
    
    public function addFilmPage() {
        $formManager = new FormManager();
        $realisateurs = $formManager->getAllRealisateurs();
        $genres = $formManager->getAllGenres();
        require 'view/admin/addFilm.php';
    }

    public function addFilm() {
        $formManager = new FormManager();
        $genres = $formManager->getAllGenres();
        $realisateurs = $formManager->getAllRealisateurs();

        if (isset($_POST["titreFilm"])) {
            // Nettoyer et valider les entrées
            $titre = filter_input(INPUT_POST, "titreFilm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $affiche = filter_input(INPUT_POST, "afficheFilm", FILTER_SANITIZE_URL);
            $duree = filter_input(INPUT_POST, "dureeFilm", FILTER_VALIDATE_INT);
            $realisateur = filter_input(INPUT_POST, "realisateurFilm", FILTER_VALIDATE_INT);
            $dateSortie = filter_input(INPUT_POST, "dateSortieFilm", FILTER_SANITIZE_NUMBER_INT);
            $note = filter_input(INPUT_POST, "noteFilm", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $synopsis = filter_input(INPUT_POST, "synopsisFilm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $genresFilm = filter_input(INPUT_POST, "genres", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

            // Vérifier la validité des données
            if ($titre && $affiche && $duree && $realisateur && $dateSortie && $note && $synopsis && !empty($genresFilm)) {
                $formManager->addFilm($titre, $affiche, $note, $duree, $realisateur, $dateSortie, $synopsis, $genresFilm);

                // Redirection après l'ajout
                header("Location: index.php?action=adminPanel");
                exit();
            }
        }

        require "view/admin/addFilm.php";
    }
    
}