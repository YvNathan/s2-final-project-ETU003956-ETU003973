<?php
ini_set("display_errors", 1);
require('connexion.php');
function creer_compte($nom, $dtn, $genre, $email, $ville, $mdp)
{
    $sql = "INSERT INTO s2fp_membres (nom, date_naissance, genre, email, ville, mdp, image_prodil) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', 'default.png')";
    $requete = sprintf($sql, $nom, $dtn, $genre, $email, $ville, $mdp);
    mysqli_query(dbconnect(), $requete);
}

function login($email, $mdp)
{
    $sql = "SELECT * FROM s2fp_membre WHERE email = '%s' AND mdp = '%s'";
    $sql = sprintf($sql, $email, $mdp);
    var_dump($sql);
    $resultat = mysqli_query(dbconnect(), $sql);
    if (mysqli_num_rows($resultat) == 0) {
        return -1;
    }
    $infosConnex = mysqli_fetch_assoc($resultat);
    mysqli_free_result($resultat);
    return $infosConnex;
}