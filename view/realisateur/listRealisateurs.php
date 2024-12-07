<?php
use Service\Utils;
ob_start();
?>

<div class="list-container">
    <div class="page-banner banner-realisateurs">
        <div class="banner-content">
            <h1>Réalisateurs</h1>
            <p><strong><?= count($realisateurs) ?></strong> Réalisateur<?= count($realisateurs) > 1 ? "s" : "" ?></p>
        </div>
        <div class="banner-content">
            <a href="index.php?action=addRealisateur" class="add-button">Ajouter un Réalisateur</a>
        </div>
    </div>

    <div class="cards-grid">
        <?php foreach($realisateurs as $realisateur) { ?>
        <div class="card">
            <img src="<?= $realisateur["photo"] ?>" alt="<?= $realisateur["realisateur"] ?>" class="card-image">
            <div class="card-content">
                <h3 class="card-title"><?= $realisateur["realisateur"] ?></h3>
            </div>
            <a href="index.php?action=detailRealisateur&id=<?= $realisateur["id_realisateur"] ?>" class="card-link"></a>
        </div>
        <?php } ?>
    </div>
</div>

<?php
$titre = "Liste des Réalisateurs";
$metaDescription = "On Air. - Découvrez tous nos réalisateurs et leurs films.";
$contenu = ob_get_clean();
require "view/template.php";
?>