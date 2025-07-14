<?php
require('../include/fonctions.php');
$objet = $_GET['o'];
$fiche = charger_fiche_objet($objet);
$histo = charger_histo_emprunts($objet);
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
    <h2>Détails sur <?= $fiche ['nom_objet']?></h2>
    <img src="../assets/images/<?= $fiche['nom_image']?>" alt="">
    
    <br>
    
    <h3>Historique de ses emprunts:</h3>
    <table >
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Date Emprunt</th>
                <th>Date Retour</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($histo as $h){?>
                <tr>
                    <td><?= $h['nom']?></td> 
                    <td><?= $h['date_emprunt']?></td>
                    <td><?= $h['date_retour']?></td>
                </tr>
            <?php }?>
        </tbody>
    </table>

</body>
</html>