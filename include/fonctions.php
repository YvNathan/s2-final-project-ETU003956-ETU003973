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
    $resultat = mysqli_query(dbconnect(), $sql);
    if (mysqli_num_rows($resultat) == 0) {
        return -1;
    }
    $infosConnex = mysqli_fetch_assoc($resultat);
    mysqli_free_result($resultat);
    return $infosConnex;
}

function charger_liste_objets()
{
    $sql = "SELECT * FROM v_s2fp_liste_objets_img";
    $requete = mysqli_query(dbconnect(), $sql);
    $resultat = array();
    while ($o = mysqli_fetch_assoc($requete)) {
        $resultat[] = $o;
    }
    mysqli_free_result($requete);
    return $resultat;
}

function charger_liste_emprunts()
{
    $sql = "SELECT * FROM v_s2fp_liste_emprunts";
    $requete = mysqli_query(dbconnect(), $sql);
    $resultat = array();
    while ($o = mysqli_fetch_assoc($requete)) {
        $resultat[] = $o;
    }
    mysqli_free_result($requete);
    return $resultat;
}

function retrouver_dans_emprunts($idObjet)
{
    $sql = "SELECT * FROM v_s2fp_liste_emprunts WHERE id_objet = %d";
    $sql = sprintf($sql, $idObjet);
    $requete = mysqli_query(dbconnect(), $sql);
    $resultat = mysqli_fetch_assoc($requete);
    mysqli_free_result($requete);
    return $resultat;
}

function charger_liste_categories()
{
    $sql = "SELECT * FROM s2fp_categorie_objet";
    $requete = mysqli_query(dbconnect(), $sql);
    $resultat = array();
    while ($c = mysqli_fetch_assoc($requete)) {
        $resultat[] = $c;
    }
    mysqli_free_result($requete);
    return $resultat;
}

function charger_liste_filtree($id_categorie)
{
    $sql = "SELECT * FROM v_s2fp_liste_objets_img WHERE id_categorie = %d";
    $sql = sprintf($sql, $id_categorie);
    $requete = mysqli_query(dbconnect(), $sql);
    $resultat = array();
    while ($o = mysqli_fetch_assoc($requete)) {
        $resultat[] = $o;
    }
    mysqli_free_result($requete);
    return $resultat;
}
