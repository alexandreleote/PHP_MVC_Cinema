<?php
    /* Require needed */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="/MVC_Cinema/public/css/style.css">

    <!-- TITLE -->
    <title>OnAir. - <?= $titre ?></title> <!-- Need to correctly write the variable getting fetched to work -->
</head>
<body>
    <!-- HEADER -->
    <header class="wrapper">
        <!-- NAVBAR -->
        <nav aria-label="Menu principal">
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Films</a></li>
                <li><a href="#">À propos</a></li>
            </ul>
        </nav>     
    </header>
    <!-- MAIN -->
    <main>
        <!-- CONTENT -->
        <?= $content?>
    </main>
    <!-- FOOTER -->
    <footer>
        <!-- DESCRIPTION -->
    </footer>
    <!-- Script -->
    <script src="/MVC_Cinema/public/js/index.js"></script>
</body>
</html>