<?php
require("../include/fonctions.php");
$categories = charger_liste_categories();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP-22-DB</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        a {
            text-decoration: none;
            color: black;
        }

        a:hover {
            color: cadetblue;
        }
    </style>
</head>

<body class="bg-light">
    <header class="fixed">
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 px-4">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold me-4" href="index.php">Test Co Enterprise</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="objets.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="recherche.php">Recherche</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-3 min-vh-100">
        <div class="card shadow">
            <div class="card-header bg-secondary text-white">
                <h2 class="card-title mb-0">Recherche d'Objets</h2>
            </div>
            <div class="card-body">
                <form action="resultat-recherche.php" method="POST">
                    <input type="hidden" name="index" value="0">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="categorie" class="form-label fw-semibold">Catégorie</label>
                            <select name="categorie" id="categorie" class="form-select" required>
                                <option value="" selected disabled hidden>-- Sélectionner une catégorie --</option>
                                <?php foreach ($categories as $c) { ?>
                                    <option value="<?= $c['id_categorie']?>"><?= $c['nom_categorie']?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="choix-nom" class="form-label fw-semibold">Type de recherche</label>
                            <select name="choix-nom" id="choix-nom" class="form-select">
                                <option value="1">Commence par</option>
                                <option value="2">Contient</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="nom" class="form-label fw-semibold">Nom de l'objet</label>
                            <input type="text" name="nom" id="nom" class="form-control" placeholder="Saisir le nom de l'objet à rechercher" required>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="disponible" id="disponible" value="1">
                                <label class="form-check-label fw-semibold" for="disponible">
                                    Disponible uniquement
                                </label>
                            </div>
                        </div>

                        <div class="col-12 d-grid">
                            <button type="submit" class="btn btn-primary btn-lg mt-3">
                                <i class="bi bi-search"></i> Rechercher
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-1">&copy; Copyright 2025</p>
            <p class="mb-0">ETU003956 - ETU003973</p>
        </div>
    </footer>
</body>

</html>