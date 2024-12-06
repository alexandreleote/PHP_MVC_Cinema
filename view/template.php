<?php
    /* Require needed */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $metaDescription ?>">
    <link rel="stylesheet" href="./public/css/style.css">
    <title>OnAir. - <?= $titre ?></title>
</head>
<body>
    <header class="site-header">
        <nav class="navbar-menu" aria-label="Menu principal">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php?action=listFilms">Films</a></li>
                <li><a href="index.php?action=listActeurs">Acteurs</a></li>
                <li><a href="index.php?action=listRealisateurs">Réalisateurs</a></li>
                <li><a href="index.php?action=adminPanel">Panneau Admin</a></li>
            </ul>
        </nav>     
    </header>

    <main id="main-content">
        <?= $contenu ?>
    </main>

    <footer class="site-footer">
        <p>&copy; <?= date('Y') ?> OnAir. Tous droits réservés.</p>
    </footer>

    <script type="module" src="./public/js/index.js"></script>
</body>
</html>