<?php
use Service\Utils;
ob_start();
?>

<section class="film-detail-container">
    <article class="film-header" style="background-image: url('<?= $modifFilm['bg'] ?? '' ?>');">
        <div class="film-content">
            <div class="film-poster-container">
                <img src="<?= $modifFilm['affiche'] ?? '' ?>" alt="<?= $modifFilm['titre_film'] ?? 'Film' ?>" class="film-poster">
            </div>

            <div class="film-info">
                <h1 class="film-title"><?= $modifFilm['titre_film'] ?? 'Titre non disponible' ?></h1>
                <div class="film-meta detail-info-row">
                    <span><?= !empty($modifFilm['sortieFilm']) 
                        ? Utils::formatDate($modifFilm['sortieFilm'], "") 
                        : 'Date non disponible' 
                    ?></span>
                    <span><?= 
                        isset($modifFilm['duree_originale']) 
                        ? $modifFilm['duree_originale'] . ' min' 
                        : 'N/A' 
                    ?></span>
                    <span><?= $modifFilm['genre'] ?? 'Genre non spécifié' ?></span>
                    <span class="rating"><?= $modifFilm['note'] ?? 'N/A' ?>/5</span>
                </div>
                <?php if (!empty($modifFilm['synopsis'])) { ?>
                    <p class="film-synopsis"><?= $modifFilm['synopsis'] ?></p>
                <?php } ?>
            </div>
        </div>
    </article>

    <section class="film-credits">
        <article class="credits-section directors">
            <h2 class="credits-title">Réalisation</h2>
            <div class="credits-grid">
                <?php foreach($modifRealisateur as $real) { ?>
                <div class="credit-card">
                    <a href="index.php?action=detailRealisateur&id=<?= $real['id_realisateur'] ?>">
                        <img src="<?= $real['photo'] ?? '' ?>" alt="<?= $real['realisateur'] ?? 'Réalisateur' ?>">
                        <div class="credit-info">
                            <h3><?= $real['realisateur'] ?? 'Nom non disponible' ?></h3>
                            <p>Réalisateur</p>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </article>

        <article class="credits-section cast">
            <h2 class="credits-title">Distribution</h2>
            <div class="credits-grid">
                <?php foreach($modifCasting as $cast) { ?>
                <div class="credit-card">
                    <a href="index.php?action=detailActeur&id=<?= $cast['id_acteur'] ?>">
                        <img src="<?= $cast['photo'] ?? '' ?>" alt="<?= $cast['acteur'] ?? 'Acteur' ?>">
                        <div class="credit-info">
                            <h3><?= $cast['acteur'] ?? 'Nom non disponible' ?></h3>
                            <p><?= $cast['nomRole'] ?? 'Rôle non spécifié' ?></p>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </article>
    </section>

    <a href="index.php?action=deleteFilm&id=<?= $modifFilm['id_film'] ?? '' ?>" class="btn-delete">Supprimer</a>
</section>

<section class="edit-forms-container">
    <h2 class="edit-section-title">Modifier les informations</h2>

    <form action="index.php?action=updateFilm&id=<?= $modifFilm['id_film'] ?? '' ?>" method="POST" class="form-edit-film">
        <div class="form-container">
            <div class="form-section identite">
                <h2>Informations du Film</h2>
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input 
                        type="text" 
                        id="titre" 
                        name="titre" 
                        value="<?= $modifFilm['titre_film'] ?? '' ?>" 
                        placeholder="Titre du film" 
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="realisateur">Réalisateur</label>
                    <select id="realisateur" name="realisateur" required>
                        <?php foreach($realisateurs as $realisateur): 
                            $selected = (!empty($modifRealisateur[0]['id_realisateur']) && $realisateur['id_realisateur'] == $modifRealisateur[0]['id_realisateur']) ? 'selected' : '';
                        ?>
                            <option value="<?= $realisateur['id_realisateur'] ?>" <?= $selected ?>>
                                <?= $realisateur['realisateur'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-section details">
                <h2>Détails</h2>
                <div class="form-group">
                    <label for="sortie">Date de Sortie</label>
                    <input 
                        type="date" 
                        id="sortie" 
                        name="sortie" 
                        value="<?= $modifFilm['sortieFilm'] ?? '' ?>" 
                        placeholder="jj/mm/aaaa"
                    >
                </div>
                <div class="form-group">
                    <label for="duree">Durée (en minutes)</label>
                    <input 
                        type="number" 
                        id="duree" 
                        name="duree" 
                        value="<?= $modifFilm['duree_originale'] ?? '' ?>" 
                        placeholder="Durée du film"
                    >
                </div>
                <div class="form-group">
                    <label for="note">Note</label>
                    <input 
                        type="number" 
                        id="note" 
                        name="note" 
                        min="0" 
                        max="5" 
                        step="0.1" 
                        value="<?= $modifFilm['note'] ?? '' ?>" 
                        placeholder="Note du film"
                    >
                </div>
            </div>

            <div class="form-section media">
                <h2>Média</h2>
                <div class="form-group">
                    <label for="affiche">Affiche (URL)</label>
                    <input 
                        type="url" 
                        id="affiche" 
                        name="affiche" 
                        value="<?= $modifFilm['affiche'] ?? '' ?>" 
                        placeholder="URL de l'affiche"
                    >
                </div>
                <div class="form-group">
                    <label for="bg">Image de Fond (URL)</label>
                    <input 
                        type="url" 
                        id="bg" 
                        name="bg" 
                        value="<?= $modifFilm['bg'] ?? '' ?>" 
                        placeholder="URL de l'image de fond"
                    >
                </div>
            </div>

            <div class="form-section synopsis">
                <h2>Synopsis</h2>
                <div class="form-group">
                    <label for="synopsis">Synopsis</label>
                    <textarea 
                        id="synopsis" 
                        name="synopsis" 
                        placeholder="Synopsis du film"
                        rows="4"
                    ><?= $modifFilm['synopsis'] ?? '' ?></textarea>
                </div>
            </div>

            <div class="form-section genres">
                <h2>Genres</h2>
                <div class="form-group">
                    <label>Genres</label>
                    <div class="genre-selection">
                        <?php 
                        // Collect current genre IDs
                        $currentGenreIds = array_column($requeteGenres, 'id_genre');
                        
                        foreach($genres as $genre): 
                            $checked = in_array($genre['id_genre'], $currentGenreIds) ? 'checked' : '';
                        ?>
                            <label class="genre-checkbox">
                                <input 
                                    type="checkbox" 
                                    name="genres[]" 
                                    value="<?= $genre['nom_genre'] ?>" 
                                    <?= $checked ?>
                                >
                                <?= $genre['nom_genre'] ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="form-section casting">
                <h2>Casting</h2>
                <div class="form-group casting-selection">
                    <label>Casting Actuel</label>
                    <div class="actor-list-container">
                        <?php 
                        if (!empty($modifCasting)) { 
                            foreach($modifCasting as $role) { 
                                // Ensure all required keys exist with default values
                                $role = array_merge([
                                    'id_acteur' => '',
                                    'prenom_personne' => 'Acteur',
                                    'nom_personne' => 'Inconnu',
                                    'photo_personne' => 'public/images/default-avatar.png',
                                    'role' => 'Rôle non spécifié'
                                ], $role);
                        ?>
                        <div class="casting-card" data-acteur-id="<?= $role['id_acteur'] ?>">
                            <input 
                                type="hidden" 
                                name="existingActeurs[]" 
                                value="<?= $role['id_acteur'] ?>"
                            >
                            <input 
                                type="hidden" 
                                name="existingRoles[]" 
                                value="<?= $role['role'] ?>"
                            >
                            <img 
                                src="<?= !empty($role['photo_personne']) ? $role['photo_personne'] : 'public/images/default-avatar.png' ?>" 
                                alt="<?= $role['prenom_personne'] . ' ' . $role['nom_personne'] ?>"
                            >
                            <div class="casting-details">
                                <h3><?= $role['prenom_personne'] . ' ' . $role['nom_personne'] ?></h3>
                                <p><?= !empty($role['role']) ? $role['role'] : 'Rôle non spécifié' ?></p>
                                <div class="casting-actions">
                                    <a href="index.php?action=removeActeurFromFilm&id=<?= $modifFilm['id_film'] ?>&idActeur=<?= $role['id_acteur'] ?>" 
                                        class="btn-remove-actor">
                                        Supprimer
                                    </a>
                                    <a href="index.php?action=editActeur&id=<?= $role['id_acteur'] ?>" 
                                        class="btn-edit-actor">
                                        Modifier
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php 
                            } 
                        } else {
                            echo '<p class="no-actors">Aucun acteur n\'a été ajouté à ce film.</p>';
                        }
                        ?>
                    </div>
                </div>

                <div class="form-group casting-selection">
                    <label>Ajouter un Acteur</label>
                    <div class="actor-add-container">
                        <select name="newActeur" id="newActeur" class="form-control">
                            <option value="">Sélectionner un acteur</option>
                            <?php 
                            // Fetch all actors from the database
                            $acteurManager = new \Model\ActeurManager();
                            $acteurs = $acteurManager->getActeurs();
                            
                            foreach($acteurs as $acteur) { 
                                // Skip actors already in the casting
                                $isInCasting = false;
                                if (!empty($modifCasting)) {
                                    foreach($modifCasting as $existingRole) {
                                        if ($existingRole['id_acteur'] == $acteur['id_acteur']) {
                                            $isInCasting = true;
                                            break;
                                        }
                                    }
                                }
                                
                                if (!$isInCasting) {
                            ?>
                            <option value="<?= $acteur['id_acteur'] ?>">
                                <?= $acteur['prenom_personne'] . ' ' . $acteur['nom_personne'] ?>
                            </option>
                            <?php 
                                }
                            } 
                            ?>
                        </select>
                        <input 
                            type="text" 
                            name="newRole" 
                            id="newRole" 
                            placeholder="Rôle de l'acteur" 
                            class="form-control"
                        >
                        <button type="button" id="addActorBtn" class="btn-add-actor">Ajouter</button>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-edit">Modifier</button>
            </div>
        </div>
    </form>
</section>

<?php
$titre = "Modifier : " . ($modifFilm['titre_film'] ?? 'Film');
$metaDescription = "On Air. - modification : " . ($modifFilm['titre_film'] ?? 'Film');
$contenu = ob_get_clean();
require "view/template.php";
?>