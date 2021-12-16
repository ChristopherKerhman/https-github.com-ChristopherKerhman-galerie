<?php
session_start();
// Déclaration des chemins
$cheminObjet = '../objets/';
$cheminCUD = '../CUD/';
// objets et fonction nécessaire au fonctionnement de la log
require $cheminObjet.'paramDB.php';
require $cheminObjet.'readDB.php';
require $cheminObjet.'cud.php';
include $cheminCUD.'fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $login = filter($_POST['login']);
  $moria = $_POST['motDePasse'];
  $requetteSQL = "SELECT `idUser`, `login`, `mdp`, `valide`, `role`
  FROM `users`
  WHERE `login` = :login";
  $prepare = [['prep'=> ':login', 'variable' => $login]];
  $readLogin = new readDB($requetteSQL, $prepare);
  $dataUser = $readLogin->read();
  if (($dataUser[0]['login'] == $login)
  && (password_verify($moria, $dataUser[0]['mdp']))
  && ($dataUser[0]['valide'] == 1)) {
    $_SESSION['idUser'] = $dataUser[0]['idUser'];
    $_SESSION['role'] = $dataUser[0]['role'];
    $_SESSION['login']= $dataUser[0]['login'];
    $_SESSION['valide'] = $dataUser[0]['valide'];
    header('location:../index.php?message="Bienvenu '.$dataUser[0]['login'].'"');
  } else {
      header('location:../index.php?message="Login ou mot de passe incorrecte"');
  }
} else {
  header('location:../index.php?message="Tentative de connexion échoué"');
}
