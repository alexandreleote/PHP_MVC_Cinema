<?php

use Service\Utils;
ob_start();

?>

<section class="hero">
    <iframe 
        class="hero-video" 
        src="<?= Utils::getYoutubeEmbedUrl($film["ba"]) ?>?autoplay=1&mute=1&controls=0&showinfo=0&rel=0&loop=1&playlist=<?= substr($film["ba"], strrpos($film["ba"], 'v=') + 2) ?>&modestbranding=1&playsinline=1"
        frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen>
    </iframe>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="hero-title"><?= $film["titre_film"] ?></h1>
        <div class="hero-meta">
            <span class="hero-genre"><?= $film["genre"] ?></span>
            <span class="hero-duration"><?= Utils::formatDuration($film["duree"]) ?></span>
            <span class="hero-director">Réalisé par <?= $film["realisateur"] ?></span>
            <span class="hero-year"><?= $film["annee_sortie"] ?></span>
        </div>
        <p class="hero-description"><?= $film["synopsis"] ?></p>
        <a href="index.php?action=detailFilm&id=<?= $film["id_film"] ?>" class="hero-cta">En savoir plus</a>
    </div>
</section>

<?php
$metaDescription = "On Air. - Découvrez notre collection de films, acteurs et réalisateurs sur OnAir - votre référence cinématographique";
$titre = "Bienvenue";
$contenu = ob_get_clean();
require "template.php";
?>