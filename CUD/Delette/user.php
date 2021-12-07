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
  $idUser = filter($_POST['idUser']);
  $requetteSQL = "DELETE FROM `users` WHERE `idUser` = :idUser";
    $prepare = [['prep'=> ':idUser', 'variable' => $idUser]];
  $creatLien = new CurDB($requetteSQL, $prepare);
  $creatLien->actionDB();
  header('location:../../index.php?message=User effacé');
  } else {
  header('location:../../index.php?message=Erreur');
  }
}
