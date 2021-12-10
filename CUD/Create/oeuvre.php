<?php
session_start();
include '../../securite/securiterCreateur.php';
print_r($_POST);
echo '<br />';
print_r($_FILES);
// Entête formulaires
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(($_FILES['nomFichier']['size'] < 1000000) ||($_FILES['nomFichier']['type'] != 'image/png') || ($_FILES['nomFichier']['type'] != 'image/jpeg') ) {
    $nomOeuvre = filter($_POST['nomOeuvre']);
    $description = filter($_POST['description']);
    $prixOeuvre = filter($_POST['prixOeuvre']);
    $createurOeuvre = filter($_POST['createurOeuvre']);
    $nomFichier = filter($_FILES['nomFichier']['name']);
    $tailleOeuvre = filter($_FILES['nomFichier']['size']);
    $prepare = [
      ['prep'=> ':nomOeuvre', 'variable' => $nomOeuvre],
      ['prep'=> ':description', 'variable' => $description],
      ['prep'=> ':prixOeuvre', 'variable' => $prixOeuvre],
      ['prep'=> ':createurOeuvre', 'variable' => $createurOeuvre],
      ['prep'=> ':nomFichier', 'variable' => $nomFichier],
      ['prep'=> ':tailleOeuvre', 'variable' => $tailleOeuvre],
    ];
      $requetteSQL = "INSERT INTO `oeuvres`(`nomOeuvre`, `description`, `nomFichier`, `prixOeuvre`, `tailleOeuvre`, `createurOeuvre`)
      VALUES (:nomOeuvre, :description, :nomFichier, :prixOeuvre, :tailleOeuvre, :createurOeuvre)";
      $record = new CurDB($requetteSQL, $prepare);
      $record->actionDB();
      move_uploaded_file($_FILES['nomFichier']['tmp_name'],$f = '../../galerieWeb/'.$nomFichier);
      chmod($f, 0777);
      header('location:../../index.php?message=Oeuvre '.$nomOeuvre.' correctement enregistrer');
  } else {
    header('location:../../index.php?message=Oeuvre non conforme');
  }
} else {
    header('location:../../index.php?message=Erreur de formulaire');
}
 ?>
