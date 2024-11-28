<?php

try /* When initialized we try to run the code */
{
    $mysqlClient = new PDO( 
        'mysql:host=localhost;dbname=cinema_alexandre;charset=utf8',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
}
catch (Exception $e) /* If there is an error then we display its type */
{
    die('Erreur : ' . $e->getMessage());
}

$sqlQuery = 'SELECT 
                    film.id_film, 
                    film.titre_film, 
                    DATE_FORMAT(film.date_sortie_film, "%Y") AS dateSortie, 
                    TIME_FORMAT(SEC_TO_TIME(film.duree_film * 60), "%H:%i") AS duree,
                    personne.prenom_personne, 
                    personne.nom_personne
                FROM film 
                INNER JOIN realisateur  ON realisateur.id_realisateur = film.id_realisateur
                INNER JOIN personne  ON personne.id_personne = realisateur.id_personne';

$filmsStatement = $mysqlClient->prepare($sqlQuery);

$filmsStatement->execute();

$films = $filmsStatement->fetchAll();

foreach($fims as $film) {
    $result = "<h1>".$film['titre_film']."</h1>";
}

?>