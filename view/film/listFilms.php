<?php

ob_start();

?>

<p>Il y a <?= $requete->rowCount() ?> films</p>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th><?= mb_strtoupper("année de sortie") ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><?= $film["titre_film"] ?></td>
                    <td><?= $film["date_sortie_film"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";