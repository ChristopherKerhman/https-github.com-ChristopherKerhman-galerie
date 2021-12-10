<?php
session_start();
include '../../securite/securiterCreateur.php';
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(($_FILES['photoIdentiter']['size'] < 1000000) ||($_FILES['photoIdentiter']['type'] != 'image/png') || ($_FILES['photoIdentiter']['type'] != 'image/jpeg') ) {
    $date = date("dmY");
    $nomArtiste = filter($_POST['nomArtiste']);
    $prenomArtiste = filter($_POST['prenomArtiste']);
    $speudo = filter($_POST['speudo']);
    $biographie = filter($_POST['biographie']);
    $valide = filter($_POST['valide']);
    $photoIdentiter = filter($_FILES['photoIdentiter']['name']);
    $prepare = [
      ['prep'=> ':nomArtiste', 'variable' => $nomArtiste],
      ['prep'=> ':prenomArtiste', 'variable' => $prenomArtiste],
      ['prep'=> ':speudo', 'variable' => $speudo],
      ['prep'=> ':biographie', 'variable' => $biographie],
      ['prep'=> ':photoIdentiter', 'variable' => $date.$photoIdentiter],
      ['prep'=> ':valide', 'variable' => $valide]];
      $requetteSQL = "INSERT INTO `artistes`( `nomArtiste`, `prenomArtiste`, `Speudo`, `biographie`, `photoIdentiter`, `valide`)
      VALUES (:nomArtiste, :prenomArtiste, :speudo, :biographie, :photoIdentiter,:valide )";
      $creatArtiste = new CurDB($requetteSQL, $prepare);
      $creatArtiste->actionDB();
      move_uploaded_file($_FILES['photoIdentiter']['tmp_name'],$f = '../../photoArtiste/'.$date.$photoIdentiter);
      chmod($f, 0777);
      header('location:../../index.php?message=Artiste '.$speudo.' correctement enregistrer');
  } else {
    header('location:../../index.php?message=Image non conforme');
  }
} else {
    header('location:../../index.php?message=Erreur de formulaire');
}
