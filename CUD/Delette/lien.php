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
  $idNav = filter($_POST['idNav']);
  $requetteSQL = "DELETE FROM `nav` WHERE `idNav` = :idNav";
    $prepare = [['prep'=> ':idNav', 'variable' => $idNav]];
  $creatLien = new CurDB($requetteSQL, $prepare);
  $creatLien->actionDB();
  header('location:../../index.php?message=Menu effacer');
  } else {
  header('location:../../index.php?message=Erreur');
  }
}
