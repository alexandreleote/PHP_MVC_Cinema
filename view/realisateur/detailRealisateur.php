<?php

use Service\Utils;
ob_start();

?>
<article>
    <figure>
        <img src="<?= $details["photo"] ?>" width=350px height=auto>
    </figure>
    <h3><?= $details["realisateur"] ?></h3>
    <p>Métiers : <?= $details["genre"]?></p>
    <p>Naissance : <?= Utils::formatDate($details["dateNaissance"], "") ?></p>
    <p>Âge : <?= $details["age"]?> ans</p>
    <section>
        <br>
        <p><?= $details["bio"]?></p>


    </section>
</article>    
<?php

$titre = "liste des réalisateurs";
$titre_secondaire = "Liste des réalisateurs";
$contenu = ob_get_clean();
require "view/template.php";