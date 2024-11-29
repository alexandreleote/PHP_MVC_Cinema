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

        require "view/realisateur/detailRealisateur.php";
    }
}
