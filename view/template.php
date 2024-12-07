<?php
    /* Require needed */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $metaDescription ?>">
    <title><?= $titre ?> | On Air.</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header role="banner">
        <nav role="navigation" aria-label="Menu principal" class="navbar">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php?action=listFilms">Films</a></li>
                <li><a href="index.php?action=listActeurs">Acteurs</a></li>
                <li><a href="index.php?action=listRealisateurs">Réalisateurs</a></li>
                <li><a href="index.php?action=adminPanel">Panneau Admin</a></li>
            </ul>
        </nav>     
    </header>

    <main role="main" class="main-container">
        <?= $contenu ?>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>À propos</h3>
                <p>On Air. est votre destination cinéma pour découvrir, explorer et partager votre passion pour le 7ème art.</p>
            </div>
            
            <div class="footer-section">
                <h3>Navigation</h3>
                <ul class="footer-links">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php?action=listFilms">Films</a></li>
                    <li><a href="index.php?action=listActeurs">Acteurs</a></li>
                    <li><a href="index.php?action=listRealisateurs">Réalisateurs</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Légal</h3>
                <ul class="footer-links">
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                    <li><a href="#">Conditions d'utilisation</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> On Air. Tous droits réservés.</p>
        </div>
    </footer>

    <script type="module" src="./public/js/index.js"></script>
</body>
</html>