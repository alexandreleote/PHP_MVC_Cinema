<?php

namespace Controller;
use Model\Connect;

class RealisateurController {

    /**
     * Lister les acteurs
     */
    public function listRealisateur() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT prenom_personne, UPPER(nom_personne) AS nom_personne
            FROM realisateur
            LEFT JOIN personne ON personne.id_personne = realisateur.id_personne
            ORDER BY nom_personne 
        ");

        require "view/realisateur/listRealisateurs.php";
    }

    public function detRealisateur($id) {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("SELECT * FROM realisateur WHERE id_realisateur = :id");
        $requete->execute(["id" => $id]);
        require "view/realisateur/detailRealisateur.php";
    }
}
