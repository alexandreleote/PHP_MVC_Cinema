<?php

namespace Controller;
use Model\Connect;

class ActeurController {

    /**
     * Lister les acteurs
     */
    public function listActeurs() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT prenom_personne, nom_personne
            FROM acteur
            LEFT JOIN personne ON personne.id_personne = acteur.id_personne
        ");

        require "view/acteur/listActeurs.php";
    }

    public function detActeur($id) {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("SELECT * FROM acteur WHERE id_acteur = :id");
        $requete->execute(["id" => $id]);
        require "view/acteur/detailActeur.php";
    }
}
