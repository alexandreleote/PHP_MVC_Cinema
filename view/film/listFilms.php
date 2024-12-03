<?php

use Service\Utils;
ob_start();

?>

<section>
    
    <p>Il y a <?= count($films) ?> films</p>
    
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th><?= mb_strtoupper("Année de sortie") ?></th>
                <th>FORMAT</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($films as $film) { ?>
                    <tr>
                        <td><a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>"><?= $film["titre_film"] ?></td>
                        <td><?= Utils::formatDate($film["date_sortie_film"], '') ?></td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>

</section>

<?php

$metaDescription = "On Air. - Liste des films";

$titre = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";