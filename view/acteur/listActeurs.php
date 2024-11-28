<?php

ob_start();

?>
<section>

    <p>Il y a <?= $requete->rowCount() ?> acteurs</p>

    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th><?= mb_strtoupper("Nom") ?></th>
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

</section>
<?php

$titre = "liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "view/template.php";