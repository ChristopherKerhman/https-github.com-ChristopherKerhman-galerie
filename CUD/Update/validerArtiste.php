<?php
session_start();
if ($_SESSION['role'] != 3) {
  header('location:https://www.google.com/');
} else {
  require '../../objets/paramDB.php';
  require '../../objets/cud.php';
  require '../../objets/readDB.php';
  include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idArtiste = filter($_POST['idArtiste']);
    $valide = filter($_POST['valide']);
  $requetteSQL = "UPDATE `artistes` SET `valide`= :valide WHERE `idArtiste` = :idArtiste";
    $prepare = [
      ['prep'=> ':idArtiste', 'variable' => $idArtiste],
      ['prep'=> ':valide', 'variable' => $valide],
  ];
  $updateArtiste = new CurDB($requetteSQL, $prepare);
  $updateArtiste->actionDB();
  header('location:../../index.php');
  } else {
  header('location:../../index.php?message=Erreur');
  }
}
