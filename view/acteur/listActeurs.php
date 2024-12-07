<?php
use Service\Utils;
ob_start();
?>

<div class="list-container">
    <div class="page-banner banner-acteurs">
        <div class="banner-content">
            <h1>Acteurs</h1>
            <p><strong><?= count($acteurs) ?></strong> Acteur<?= count($acteurs) > 1 ? "s" : "" ?></p>
        </div>
        <div class="banner-content">
            <a href="index.php?action=addActeur" class="add-button">Ajouter un Acteur</a>
        </div>
    </div>

    <div class="cards-grid">
        <?php foreach($acteurs as $acteur) { ?>
        <div class="card">
            <img src="<?= $acteur["photo"] ?>" alt="<?= $acteur["acteur"] ?>" class="card-image">
            <div class="card-content">
                <h3 class="card-title"><?= $acteur["acteur"] ?></h3>
            </div>
            <a href="index.php?action=detailActeur&id=<?= $acteur["id_acteur"] ?>" class="card-link"></a>
        </div>
        <?php } ?>
    </div>
</div>

<?php
$titre = "Liste des Acteurs";
$metaDescription = "On Air. - Découvrez tous nos acteurs et leurs films.";
$contenu = ob_get_clean();
require "view/template.php";
?>