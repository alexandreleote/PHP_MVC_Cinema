<?php
use Service\Utils;
ob_start();
?>

<!-- Contenu de la page -->
<div class="detail-header">
    <img src="<?= $details["photo"] ?>" alt="<?= $details["realisateur"] ?>" class="detail-image">
    
    <div class="detail-info">
        <h1 class="detail-title"><?= $details["realisateur"] ?></h1>
        
        <div class="detail-meta">
            <div class="meta-item">
                <span class="meta-label">Date de naissance:</span>
                <span><?= Utils::formatDate($details["dateNaissance"], "") ?></span>
            </div>
            <?php if ($details["dateMort"]) { ?>
            <div class="meta-item">
                <span class="meta-label">Date de décès:</span>
                <span><?= Utils::formatDate($details["dateMort"], "") ?></span>
            </div>
            <?php } ?>
            <div class="meta-item">
                <span class="meta-label">Métier(s):</span>
                <span><?= Utils::getMetiers($details) ?></span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Âge:</span>
                <span><?= Utils::getAge($details["dateNaissance"], $details["dateMort"])?> ans</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Nombre de films:</span>
                <span><?= count($filmographie) ?> film<?= count($filmographie) > 1 ? 's' : '' ?></span>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($details["bio"])) { ?>
    <section aria-label="Biographie">
        <h2>Biographie</h2>
        <p><?= $details["bio"] ?></p>
    </section>
<?php } ?>

<div class="filmography">
    <h2 class="filmography-title">Filmographie en tant que réalisateur</h2>
    <div class="cards-grid">
        <?php foreach($filmographie as $film) { ?>
        <div class="card">
            <img src="<?= $film["affiche"] ?>" alt="<?= $film["titre_film"] ?>" class="card-image">
            <div class="card-content">
                <h3 class="card-title"><?= $film["titre_film"] ?></h3>
                <div class="card-meta">
                    <span class="card-year"><?= Utils::formatDate($film["annee_sortie"], "") ?></span>
                </div>
            </div>
            <a href="index.php?action=detailFilm&id=<?= $film["id_film"] ?>" class="card-link"></a>
        </div>
        <?php } ?>
    </div>
</div>

<button aria-label="Actions sur le réalisateur">
    <a href="index.php?action=editRealisateur&id=<?= $details["id_realisateur"] ?>" role="button">Modifier</a>
</button>

<?php
$titre = "Détail du réalisateur - " . $details["realisateur"];
$metaDescription = "On Air. - Découvrez la filmographie complète de " . $details["realisateur"];
$contenu = ob_get_clean();
require "view/template.php";
?>