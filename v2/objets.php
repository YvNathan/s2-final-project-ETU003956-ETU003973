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
    <style>
        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .card-link:hover {
            text-decoration: none;
            color: inherit;
        }

        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        .card-img-top {
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="container text-center mt-5">
            <h1 class="display-4 fw-bold text-dark mb-3">Liste des Objets</h1>
            <p class="text-muted">Système de gestion des objets empruntables</p>
        </div>

        <div class="d-flex justify-content-between">
            <div class="d-flex justify-content-start mb-4">
                <a href="ajout.php" class="btn btn-outline-primary">Ajouter un objet</a>
            </div>

            <div class="d-flex justify-content-end mb-4">
                <a href="traitements/deconnexion.php" class="btn btn-outline-danger">Se déconnecter</a>
            </div>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <form action="objets.php" method="get" class="d-flex align-items-center gap-3">
                <label for="choix" class="form-label mb-0">Filtrer par catégorie :</label>
                <select name="choix" id="choix" class="form-select" style="width: auto;">
                    <?php foreach ($categories as $c) { ?>
                        <option value="<?= $c['id_categorie'] ?>"><?= $c['nom_categorie'] ?></option>
                    <?php } ?>
                </select>
                <input type="submit" value="Filtrer" class="btn btn-primary">
                <?php if (isset($_GET['choix'])) { ?>
                    <a href="objets.php" class="btn btn-secondary">Enlever filtre</a>
                <?php } ?>
            </form>
        </div>

        <div class="py-5">
            <div class="row g-4">
                <?php foreach ($liste as $o) { ?>
                    <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="card shadow-sm h-100">
                            <div class="position-relative">
                                <img src="../assets/images/<?= $o['nom_image'] ?>" class="card-img-top" alt="Photo objet" style="height: 200px; object-fit: cover;">
                            </div>
                            <div class="mt-2 position-absolute">
                                <span class="ms-3 badge bg-primary"><a href="ficheObjet.php?o=<?= $o['id_objet']?>"><?= $o['nom_categorie'] ?></a></span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold"><a href="ficheObjet.php?o=<?= $o['id_objet']?>"><?= $o['nom_objet'] ?></a></h5>
                                <p class="card-text text-muted mb-3">
                                    <i class="bi bi-tag"></i> Catégorie: <?= $o['nom_categorie'] ?>
                                </p>
                                <div class="mt-auto">
                                    <?php if (is_array($emprunt = retrouver_dans_emprunts($o['id_objet']))) { ?>
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="badge bg-info">
                                                <i class="bi bi-calendar-check"></i> Emprunté le: <?= $emprunt['date_emprunt'] ?>
                                            </span>
                                            <span class="badge bg-warning">
                                                <i class="bi bi-calendar-x"></i> Retour: <?= $emprunt['date_retour'] ?>
                                            </span>
                                        </div>
                                    <?php } else { ?>
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle"></i> Disponible
                                        </span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</body>

</html>