<?php

ob_start();

?>

<article>
    <br><h3> <?= $details['titre_film'] ?> </h3><br>
    <figure>
        <img src="<?= $details["affiche"] ?>">
    </figure>
    <p>Réalisation : 
        <?php foreach($realisateur as $real) {
                echo $real['realisateur'].'<br>';
            };
        ?></p>
<?php 

    $result = "<br><p>Casting : </p><br>";
    foreach($casting as $cast) {
        $result .= $cast["acteur"]." dans le rôle de ".$cast["nomRole"]."<br>";
    }
    echo $result;
?>
</article>
<aside>
    <p><?= $details["synopsis"]?></p>
</aside>

<?php

$metaDescription = 
    "On Air. - ".$details["titre_film"].
    " , réalisation : ".$real["realisateur"];

$titre = "détails du film";
$titre_secondaire = "Détails du film";
$contenu = ob_get_clean();
require "view/template.php";