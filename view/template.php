<?php
    /* Require needed */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $metaDescription ?>">
    <!-- CSS -->
    <link rel="stylesheet" href="./public/css/style.css">

    <!-- TITLE -->
    <title>OnAir. - <?= $titre ?></title> <!-- Need to correctly write the variable getting fetched to work -->
</head>
<body>
    <!-- HEADER -->
    <header>
        <!-- NAVBAR -->
        <nav aria-label="Menu principal" class="navbar-menu">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php?action=listFilms">Films</a></li>
                <li><a href="index.php?action=listActeurs">Acteurs</a></li>
                <li><a href="index.php?action=listRealisateurs">Réalisateurs</a></li>
                <li><a href="index.php?action=monCompte">Mon compte</a></li>
            </ul>
        </nav>     
    </header>
    <!-- MAIN -->
    <main>
        <div id="contenu">
            <!-- CONTENT -->
            <?= $contenu ?>
        </div>
    </main>
    <!-- FOOTER -->
    <footer>
        <!-- DESCRIPTION -->
    </footer>
    <!-- SCRIPT -->
    <script src="./public/js/index.js"></script>
</body>
</html>