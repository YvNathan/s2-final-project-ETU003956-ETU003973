<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S2-Final-project</title>
</head>

<body>
    <div class="login-container">
        <h2>Créer un compte</h2>
        <form action="traitements/traitement-login.php" method="post">
            <div class="form-group">
                <label for="nom">Nom et Prénoms</label>
                <input type="text" id="nom" name="nom" /><br>

                <input type="radio" id="homme" name="genre" value="H">
                <label for="homme">Homme</label>

                <input type="radio" id="femme" name="genre" value="F">
                <label for="femme">Femme</label><br>

                <label for="dtn">Date de naissance</label>
                <input type="date" name="dtn" id="dtn">

                <label for="ville">Ville</label>
                <input type="text" id="ville" name="ville" /> <br>

                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" placeholder="exemple@email.com" />

                <label for="mdp">Mot de passe</label>
                <input type="password" id="mdp" name="mdp" />

            </div>
            <button type="submit" class="btn-login">Se connecter</button>
        </form>
    </div>
</body>

</html>