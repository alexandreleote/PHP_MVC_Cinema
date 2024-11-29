<?php

use Service\Utils;
ob_start();

?>
<article>
    <figure>
        <img src="<?= $details["photo"] ?>" width=350px>
    </figure>
    <h3><?= $details["acteur"] ?></h3>
    <p>Métiers : <?= $details["genre"]?></p>
    <p>Naissance : <?= Utils::formatDate($details["dateNaissance"], "") ?></p>
    <p>Âge : <?= $details["age"]?> ans</p>
    <section>
        <br>
        <p><?= $details["bio"]?></p>


    </section>
</article>    
<?php

$titre = "détail des acteurs";
$titre_secondaire = "Détails des acteurs";
$contenu = ob_get_clean();
require "view/template.php";