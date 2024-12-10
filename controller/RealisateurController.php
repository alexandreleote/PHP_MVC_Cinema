<?php

namespace Controller;
use Model\RealisateurManager;

class RealisateurController {

    /**
     * Lister les acteurs
     */
    public function listRealisateurs() {

        $realisateurManager = new RealisateurManager();
        $realisateurs = $realisateurManager->getRealisateurs();

        require "view/realisateur/listRealisateurs.php";
    }

    public function detRealisateur($id) {

        $realisateurManager = new RealisateurManager();
        $details = $realisateurManager->getDetRealisateur($id);
        $filmographie = $realisateurManager->getFilmographie($id);
        
        if(!$details) {
            header("Location: index.php");
            exit();
        }

        require "view/realisateur/detailRealisateur.php";
    }
}
