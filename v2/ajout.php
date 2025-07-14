<?php
require('../include/fonctions.php');
session_start();
$categorie = charger_liste_categories();
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
        .form-label {
            font-weight: 500;
            color: #333;
        }
        .form-control, .form-select {
            border-radius: 0.375rem;
            border: 1px solid #ced4da;
        }
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .btn-primary {
            border-radius: 0.375rem;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="container text-center mt-5">
            <h1 class="display-4 fw-bold text-dark mb-3">Ajouter un objet</h1>
        </div>

        <div class="d-flex justify-content-between mb-4">
            <div class="d-flex justify-content-start">
                <a href="objets.php" class="btn btn-outline-primary">Retour à la liste</a>
            </div>
            <div class="d-flex justify-content-end">
                <a href="traitements/deconnexion.php" class="btn btn-outline-danger">Se déconnecter</a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <form action="./traitements/traitement-upload.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nom_objet" class="form-label">Objet :</label>
                        <input type="text" name="nom_objet" id="nom_objet" class="form-control" placeholder="Nom de votre objet" required>
                    </div>
                    <div class="mb-3">
                        <label for="choix_categorie" class="form-label">Catégorie :</label>
                        <select name="choix_categorie" id="choix_categorie" class="form-select">
                            <?php foreach ($categorie as $c) { ?>
                                <option value="<?= $c['id_categorie'] ?>"><?= $c['nom_categorie'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fichier" class="form-label">Ajouter image(s) :</label>
                        <input class="form-control" type="file" name="fichier[]" id="fichier" multiple>
                        <div class="form-text">Taille max : 25 Mo</div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-cloud-arrow-up me-1"></i>Uploader
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>