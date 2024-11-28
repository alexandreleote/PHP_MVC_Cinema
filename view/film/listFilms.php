<?php

ob_start();

?>

<section>
    
    <p>Il y a <?= count($films) ?> films</p>
    
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Année de sortie</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($films as $film) { ?>
                    <tr>
                        <td><a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>"><?= $film["titre_film"] ?></td>
                        <td><?= $film["annee_sortie"] ?></td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>

</section>

<?php

$titre = "liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";