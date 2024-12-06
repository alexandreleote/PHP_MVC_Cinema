<?php
use Service\Utils;
ob_start();
?>

<div class="detail-container">
    <div class="detail-content">
        <div class="detail-image-container">
            <img src="<?= $details["photo"] ?>" alt="Photo de <?= $details["realisateur"] ?>" class="detail-image">
        </div>
        
        <div class="detail-info">
            <h1><?= $details["realisateur"] ?></h1>
            
            <div class="detail-meta">
                <p>Métier(s) : <?= Utils::getMetiers($details) ?></p>
                <p>Naissance : <?= Utils::formatDate($details["dateNaissance"], "") ?></p>
                <?php if (isset($details["dateMort"]) && $details["dateMort"] !== null) { ?>
                    <p>Décès : <?= Utils::formatDate($details["dateMort"], "") ?></p>
                <?php } ?>
                <p>Âge : <?= Utils::getAge($details["dateNaissance"], $details["dateAge"])?> ans</p>
            </div>

            <div class="detail-bio">
                <p><?= $details["bio"]?></p>
            </div>
        </div>
    </div>
</div>

<?php
$metaDescription = "On Air. - ".$details["realisateur"]." : toutes les informations à son sujet. Filmographie, biographie...";
$titre = $details["realisateur"];
$contenu = ob_get_clean();
require "view/template.php";
?>