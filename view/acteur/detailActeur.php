<?php
use Service\Utils;
ob_start();
?>

<aside class="sticky-edit-button">
    <a href="index.php?action=editActeur&id=<?= $details["id_acteur"] ?>" class="btn-primary">Modifier l'Acteur</a>
</aside>

<article class="detail-container">
    <header class="detail-header">
        <h1><?= $details["acteur"] ?></h1>
    </header>

    <div class="detail-content">
        <aside class="detail-image-container">
            <img src="<?= $details["photo"] ?>" alt="Photo de <?= $details["acteur"] ?>" class="detail-image">
        </aside>
        
        <section class="detail-info">
            <div class="detail-meta">
                <p>Métier(s) : <?= Utils::getMetiers($details) ?></p>
                <p>Naissance : <?= Utils::formatDate($details["dateNaissance"], "") ?></p>
                <?php if (!empty($details["dateMort"])) { ?>
                    <p>Décès : <?= Utils::formatDate($details["dateMort"], "") ?></p>
                <?php } ?>
                <p>Âge : <?= Utils::getAge($details["dateNaissance"], $details["dateAge"])?> ans</p>
            </div>

            <section class="detail-bio">
                <h2>Biographie</h2>
                <p><?= $details["bio"]?></p>
            </section>
        </section>
    </div>
</article>

<?php
$titre = $details["acteur"];
$metaDescription = "On Air. - ".$details["acteur"]." : toutes les informations à son sujet. Filmographie, best-sellers...";
$contenu = ob_get_clean();
require "view/template.php";
?>