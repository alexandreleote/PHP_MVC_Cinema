<?php
use Service\Utils;
ob_start();
?>

<!-- Contenu de la page -->
<div class="detail-header">
    <img src="<?= $details["photo"] ?>" alt="<?= $details["acteur"] ?>" class="detail-image">
    
    <div class="detail-info">
        <h1 class="detail-title"><?= $details["acteur"] ?></h1>
        
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
        </div>
    </div>
</div>

<div class="filmography">
    <h2 class="filmography-title">Filmographie</h2>
    <div class="cards-grid">
        <?php foreach($filmographie as $film) : ?>
        <div class="card">
            <img src="<?= $film["affiche"] ?>" alt="<?= $film["titre_film"] ?>" class="card-image">
            <div class="card-content">
                <h3 class="card-title"><?= $film["titre_film"] ?></h3>
                <div class="card-meta">
                    <span class="card-year"><?= Utils::formatDate($film["annee_sortie"], "") ?></span>
                    <span class="card-role"><?= $film["nomRole"] ?></span>
                </div>
            </div>
            <a href="index.php?action=detailFilm&id=<?= $film["id_film"] ?>" class="card-link"></a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Bouton de modification -->
<button aria-label="Actions sur l'acteur">
    <a href="index.php?action=editActeur&id=<?= $details["id_acteur"] ?>" role="button">Modifier</a>
</button>

<?php
$titre = "Détail de l'acteur - " . $details["acteur"];
$metaDescription = "On Air. - Découvrez la filmographie complète de " . $details["acteur"];
$contenu = ob_get_clean();
require "view/template.php";
?>