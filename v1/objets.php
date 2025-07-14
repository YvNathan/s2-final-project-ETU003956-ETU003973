<?php
require('../include/fonctions.php');

if (!isset($_GET['choix'])) {
    $liste = charger_liste_objets();
} else {
    $liste = charger_liste_filtree($_GET['choix']);
}
$categories = charger_liste_categories();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S2-Final-project</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Listes des Objets</h2>
            <a href="traitements/deconnexion.php" class="btn btn-outline-danger">Se déconnecter</a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form action="objets.php" method="get" class="row g-3 align-items-end">
                    <div class="col-md-8">
                        <label for="choix" class="form-label">Filtrer par catégorie</label>
                        <select name="choix" id="choix" class="form-select">
                            <?php foreach ($categories as $c) { ?>
                                <option value="<?= $c['id_categorie'] ?>"><?= $c['nom_categorie'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="submit" value="Filtrer" class="btn btn-primary">
                        <?php if (isset($_GET['choix'])) { ?>
                            <a href="objets.php" class="btn btn-secondary ms-2">Enlever filtre</a>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Nom Objet</th>
                                <th>Categorie</th>
                                <th>Date Emprunt</th>
                                <th>Date Retour</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($liste as $o) { ?>
                                <tr>
                                    <td><?= $o['nom_objet'] ?></td>
                                    <td><?= $o['nom_categorie'] ?></td>
                                    <?php if (is_array($emprunt = retrouver_dans_emprunts($o['id_objet']))) { ?>
                                        <td><span class="badge bg-info"><?= $emprunt['date_emprunt'] ?></span></td>
                                        <td><span class="badge bg-warning"><?= $emprunt['date_retour'] ?></span></td>
                                    <?php } else { ?>
                                        <td><span class="text-muted">-</span></td>
                                        <td><span class="text-muted">-</span></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>