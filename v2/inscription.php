<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S2-Final-project</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow mt-4">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Créer un compte</h2>

                        <form action="traitements/traitement-login.php" method="post">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom et Prénoms</label>
                                <input type="text" class="form-control" id="nom" name="nom" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Genre</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="homme" name="genre" value="H" required>
                                    <label class="form-check-label" for="homme">Homme</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="femme" name="genre" value="F" required>
                                    <label class="form-check-label" for="femme">Femme</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="dtn" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" name="dtn" id="dtn" required>
                            </div>

                            <div class="mb-3">
                                <label for="ville" class="form-label">Ville</label>
                                <input type="text" class="form-control" id="ville" name="ville" required />
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse e-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="exemple@email.com" required />
                            </div>

                            <div class="mb-3">
                                <label for="mdp" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="mdp" name="mdp" required />
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Créer le compte</button>
                            </div>
                        </form>

                        <div class="row mt-4">
                            <p class="text-center text_muted">Vous avez déjà un compte</p>
                            <a href="login.php" class="btn btn-success">Se connecter</a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>