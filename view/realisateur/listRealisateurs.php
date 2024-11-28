<?php

ob_start();

?>
<section>
        
    <p>Il y a <?= $requete->rowCount() ?> réalisateurs</p>

    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th><?= mb_strtoupper("Nom") ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($requete->fetchAll() as $realisateur) { ?>
                    <tr>
                        <td><?= $realisateur["prenom_personne"] ?></td>
                        <td><?= $realisateur["nom_personne"] ?></td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>

</section>    
<?php

$titre = "liste des réalisateurs";
$titre_secondaire = "Liste des réalisateurs";
$contenu = ob_get_clean();
require "view/template.php";