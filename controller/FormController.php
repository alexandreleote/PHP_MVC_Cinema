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
            $nomGenre = filter_input(INPUT_POST, "nomGenre", FILTER_SANITIZE_STRING);
            
            if ($nomGenre) {
                $formManager->addGenre($nomGenre);
            }
        }

        $formManager = new FormManager();
        $genres = $formManager->getAllGenres();

        require "view/admin/addGenre.php";
    }
    
    public function addFilm() {
        $formManager = new FormManager();
        
        // Fetch data needed for the form
        $genres = $formManager->getAllGenres();
        $realisateurs = $formManager->getAllRealisateurs();

        require "view/admin/addFilm.php";
    }
    
}