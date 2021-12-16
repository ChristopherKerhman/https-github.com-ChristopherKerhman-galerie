<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $idOeuvre = filter($_POST['idOeuvre']);
    // Récupération de la valeur de cool
    $requetteSQL = "SELECT `cool` FROM `oeuvres` WHERE `idOeuvre`= :idOeuvre";
    $prepare = [['prep'=> ':idOeuvre', 'variable' => $idOeuvre]];
    $readCool = new readDB($requetteSQL, $prepare);
    $oldCool = $readCool->read();
    $oldCool = $oldCool[0]['cool'];
    $cool = 1 + $oldCool;
    $requetteSQL = "UPDATE `oeuvres` SET `cool`= :cool WHERE `idOeuvre` = :idOeuvre";
    $prepare = [
      ['prep'=> ':idOeuvre', 'variable' => $idOeuvre],
      ['prep'=> ':cool', 'variable' => $cool]];
      $updateCool = new CurDB($requetteSQL, $prepare);
      $updateCool->actionDB();
  header('location:../../index.php?idNav='.$idNav.'');
  } else {
    header('location:../../index.php?message=Erreur de traitement');
  }

 ?>
