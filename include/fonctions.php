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

function charger_fiche_objet($id_objet)
{
    $sql = "SELECT * 
            FROM v_s2fp_liste_objets_img 
            WHERE id_objet = %d";
    $sql = sprintf($sql, $id_objet);
    $requete = mysqli_query(dbconnect(), $sql);
    if (!$requete) {
        return false;
    }

    $resultat = mysqli_fetch_assoc($requete);
    mysqli_free_result($requete);
    return $resultat;
}

function charger_histo_emprunts($id_objet)
{
    $sql = "SELECT *
            FROM v_s2fp_liste_emprunts
            WHERE id_objet = %d";
    $sql = sprintf($sql, $id_objet);
    $requete = mysqli_query(dbconnect(), $sql);
    if (!$requete) {
        return false;
    }

    $resultat = array();
    while ($fiche = mysqli_fetch_assoc($requete)) {
        $resultat[] = $fiche;
    }

    mysqli_free_result($requete);
    return $resultat;
}

function charger_fiche_membre($id_membre)
{
    $sql = "SELECT *
            FROM v_s2fp_liste_membre
            WHERE id_membre = %d";
    $sql = sprintf($sql, $id_membre);
    $requete = mysqli_query(dbconnect(), $sql);
    if (!$requete) {
        return false;
    }

    $resultat = array();
    while ($fiche = mysqli_fetch_assoc($requete)) {
        $resultat[] = $fiche;
    }

    mysqli_free_result($requete);
    return $resultat;
}

function uploadMedia($file, $uploadDir, $allowedMimeTypes)
{
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $maxSize = 25 * 1024 * 1024;

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['resultat_upload' => false, 'message' => 'Erreur lors de l’upload : ' . $file['error']];
    }

    if ($file['size'] > $maxSize) {
        return ['resultat_upload' => false, 'message' => 'Le fichier est trop volumineux.'];
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowedMimeTypes)) {
        return ['resultat_upload' => false, 'message' => 'Type de fichier non autorisé : ' . $mime];
    }

    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (str_starts_with($mime, 'video/')) {
        $newName = 'vid_' . $originalName . '_' . uniqid() . '.' . $extension;
    } elseif (str_starts_with($mime, 'image/')) {
        $newName = 'img_' . $originalName . '_' . uniqid() . '.' . $extension;
    } else {
        return ['resultat_upload' => false, 'message' => 'Type de fichier non reconnu.'];
    }

    if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
        return ['resultat_upload' => true, 'message' => 'Fichier uploadé avec succès : ' . $newName];
    } else {
        return ['resultat_upload' => false, 'message' => 'Échec du déplacement du fichier.'];
    }
}

function ajouter_objet($objet, $categorie, $id_membre){
    $sql = "INSERT INTO s2fp_objet (nom_objet, id_categorie, id_membre) VALUES ('%s', %d, %d)";
    $sql = sprintf($sql, $objet, $categorie, $id_membre);
    mysqli_query(dbconnect(), $sql);
}