<?php
    session_start();
    ob_start();
    $titre = 'Accueil';
?>

<?php

$content = ob_get_clean();

require_once "view/template.php"; ?>