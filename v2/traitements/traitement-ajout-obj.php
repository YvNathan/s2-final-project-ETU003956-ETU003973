<?php
require("../../include/fonctions.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['nom_objet']) || !isset($_POST['choix_categorie'])) {
    header('Location: ../ajout.php');
    exit;
}

$nom_objet = $_POST['nom_objet'];
$categorie = $_POST['choix_categorie'];
$id_membre = $_SESSION['id_membre'];

$uploadDir = __DIR__ . '/../../assets/images/';
$allowedMimeTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
$max_size = 25 * 1024 * 1024;

ajouter_objet($nom_objet, $categorie, $id_membre);

$id_objet = recuperer_dernier_id();

if (!empty($_FILES['fichier']['name'][0])) {
    foreach ($_FILES['fichier']['name'] as $key => $name) {
        if ($_FILES['fichier']['error'][$key] === UPLOAD_ERR_OK) {
            $file = [
                'name' => $_FILES['fichier']['name'][$key],
                'type' => $_FILES['fichier']['type'][$key],
                'tmp_name' => $_FILES['fichier']['tmp_name'][$key],
                'error' => $_FILES['fichier']['error'][$key],
                'size' => $_FILES['fichier']['size'][$key]
            ];

            if ($file['size'] > $maxSize) {
               echo "Erreur : Le fichier $name est trop volumineux.";
                continue;
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);
            if (!in_array($mime, $allowedMimeTypes)) {
                echo "Erreur : Type de fichier non autorisé pour $name : $mime";
                continue;
            }

            $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newName = $originalName . '_' . uniqid() . '.' . $extension;

            if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
                ajouter_image($newName, $id_objet);
                echo "Succès : Fichier $newName uploadé avec succès.";
            } else {
                echo "Erreur : Échec du déplacement du fichier $name.";
            }
        } else {
            echo "Erreur : Aucun fichier valide n'a été uploadé pour $name.";
        }
    }
} else {
    $messages[] = "Aucune image uploadée";
}

header('Location: ../ajout.php');
