<?php
session_start();
if ($_SESSION['role'] == 1) {
  header('location:https://www.google.com/');
}
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
print_r($_POST);
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $idOeuvre = filter($_POST['idOeuvre']);
  $commentaire = filter($_POST['commentaire']);
  $idUser = $_SESSION['idUser'];
    $prepare = [
      ['prep'=> ':idOeuvre', 'variable' => $idOeuvre],
      ['prep'=> ':idUser', 'variable' => $idUser],
      ['prep'=> ':commentaire', 'variable' => $commentaire]];
    $requetteSQL = "INSERT INTO `commentaires`( `idoeuvre`, `idUser`, `commentaire`)
    VALUES (:idOeuvre, :idUser, :commentaire)";
    $creatCommentaire = new CurDB($requetteSQL, $prepare);
    $creatCommentaire->actionDB();

  header('location:../../index.php?idNav='.$idNav.' & idOeuvre= '.$idOeuvre.'&message=Commentaire enregistré, , il sera validé par la modération dans quelques heures.');
} else {
  header('location:../../index.php?message=Erreur d\'enregistrement du commentaire.');
}
