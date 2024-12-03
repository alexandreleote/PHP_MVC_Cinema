<?php

ob_start();

?>
<section>
        
    <p>Il y a <?= count($realisateurs) ?> réalisateurs</p><br>

    <table>
        <thead>
            <tr>
                <th><?= mb_strtoupper("réalisateurs") ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($realisateurs as $realisateur) { ?>
                    <tr>
                        <td><a href="index.php?action=detailRealisateur&id=<?= $realisateur['id_realisateur'] ?>"><?= $realisateur["realisateur"] ?></td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>

</section>    
<?php

$metaDescription = "On Air. - Liste des réalisateurs";
$titre = "liste des réalisateurs";
$titre_secondaire = "Liste des réalisateurs";
$contenu = ob_get_clean();
require "view/template.php";