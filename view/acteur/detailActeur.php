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
            foreach($requete->fetchAll() as $acteur) { ?>
                <tr>
                    <td><?= $acteur["prenom_personne"] ?></td>
                    <td><?= $acteur["nom_personne"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "détail des acteurs";
$titre_secondaire = "Détails des acteurs";
$contenu = ob_get_clean();
require "view/template.php";