<?php
session_start();
include '../../securite/securiterCreateur.php';
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $idOeuvre = filter($_POST['idOeuvre']);
    $idCommentaire = filter($_POST['idCommentaire']);
    $valide = filter($_POST['valide']);
  $SQL = "UPDATE `commentaires` SET `valide`= :valide WHERE `idCommentaire` = :idCommentaire";
  $pre = [['prep'=> ':idCommentaire', 'variable' => $idCommentaire],
          ['prep'=> ':valide', 'variable' => $valide]];
  $administrerCommentaire = new CurDB($SQL, $pre);
  $administrerCommentaire->actionDB();
  if ($valide == 1) {
    header('location:../../index.php?idNav='.$idNav.' & idOeuvre= '.$idOeuvre.'&message=Commentaire validé.');
  } else {
    header('location:../../index.php?idNav='.$idNav.' & idOeuvre= '.$idOeuvre.'&message=Commentaire non-validé.');
  }
  } else {
    header('location:../../index.php?message=Erreur de traitement');
  }
 ?>
