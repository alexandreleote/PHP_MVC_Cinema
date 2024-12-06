<?php
use Service\Utils;
ob_start();
?>

<div class="sticky-delete-button">
    <a href="index.php?action=deleteActeur&id=<?= $details["id_acteur"] ?>" class="btn-primary">Supprimer l'Acteur</a>
</div>

<div class="detail-container">
    <div class="detail-content">
        <div class="detail-image-container">
            <img src="<?= $details["photo"] ?>" alt="Photo de <?= $details["acteur"] ?>" class="detail-image">
        </div>
        
        <div class="detail-info">
            <h1><?= $details["acteur"] ?></h1>
            
            <div class="detail-meta">
                <p>Métier(s) : <?= Utils::getMetiers($details) ?></p>
                <p>Naissance : <?= Utils::formatDate($details["dateNaissance"], "") ?></p>
                <?php if (!empty($details["dateMort"])) { ?>
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
$metaDescription = "On Air. - ".$details["acteur"]." : toutes les informations à son sujet. Filmographie, best-sellers...";
$titre = $details["acteur"];
$contenu = ob_get_clean();
require "view/template.php";
?>