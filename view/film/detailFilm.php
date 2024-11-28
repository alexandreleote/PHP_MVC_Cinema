<?php

ob_start();

?>

<p>Page de : <?= $requete->fetch($id) ?></p>

<table>
    <thead>
        <tr>
            <th>Prénom</th>
            <th><?php mb_strtoupper("Nom") ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><?= $film["prenom_personne"] ?></td>
                    <td><?= $film["nom_personne"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "détail des films";
$titre_secondaire = "Détails des films";
$contenu = ob_get_clean();
require "view/template.php";