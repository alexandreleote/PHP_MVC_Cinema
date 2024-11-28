<?php

ob_start();

?>

<h1>Homepage</h1>

<?php

$titre = "Home";
$titre_secondaire = "Home";
$contenu = ob_get_clean();
require "template.php";