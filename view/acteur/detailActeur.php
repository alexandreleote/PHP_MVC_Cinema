<?php

use Service\Utils;
ob_start();

?>
<article>
    <figure>
        <img src="<?= $details["photo"] ?>">
    </figure>
    <h3><?= $details["acteur"] ?></h3>
    <p>Métier(s) : <?= Utils::getMetiers($details) ?></p>
    <p>Naissance : <?= Utils::formatDate($details["dateNaissance"], "") ?></p>
    <p>Âge : <?= Utils::getAge($details["dateNaissance"], $details["dateAge"])?> ans</p>
    <section>
        <br>
        <p><?= $details["bio"]?></p>


    </section>
</article>    
<?php

$metaDescription = 
    "On Air. - ".$details["acteur"].
    " : toutes les informations à son sujet. Filmographie, best-sellers...";
    
$titre = $details["acteur"];
$contenu = ob_get_clean();
require "view/template.php";