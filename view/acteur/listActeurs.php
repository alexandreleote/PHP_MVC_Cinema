<?php

ob_start();
?>
<section>
    <p>Il y a <?= count($acteurs) ?> acteurs</p><br>

    <table>
        <thead>
            <tr>
                <th><?= mb_strtoupper("Acteurs") ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($acteurs as $acteur) { ?>
                    <tr>
                        <td><a href="index.php?action=detailActeur&id=<?= $acteur['id_acteur']?>"><?= $acteur["acteurs"] ?></td>
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