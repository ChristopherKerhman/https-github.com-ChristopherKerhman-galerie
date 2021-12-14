<?php
include 'commerce/readCommande.php';
require 'objets/contenusCommande.php';
//Lire le devis du Client
$requetteSQL = "SELECT `idCommande`, `statutsCommande` FROM `commandes` WHERE `statutsCommande` = 0";
$prepare = [];
$devis = readCommande($requetteSQL, $prepare);
if(!empty($devis)) {
  // On affiche les détails de la commande
  $prepare = [['prep'=> ':idDevis', 'variable' => $devis[0]['idCommande']]];
  $requetteSQL = "SELECT `idArticle`, `idDevis`, `prixHT`, `detailCommande`.`idOeuvre`, `nomOeuvre` FROM `detailCommande`
  INNER JOIN `oeuvres` ON `oeuvres`.`idOeuvre` = `detailCommande`.`idOeuvre`
  WHERE `idDevis` = :idDevis";
  $details = readCommande($requetteSQL, $prepare);
  $requetteSQL = "SELECT SUM(`prixHT`) AS `total` FROM `detailCommande` WHERE `idDevis` = :idDevis";
  $TotalCommande = readCommande($requetteSQL, $prepare);
  $contenusDevis = new contenusDevis ($devis, $details, $idNav, $TotalCommande);
  $contenusDevis->affichageContenus();
  $contenusDevis->signerDevis();
} else {
  echo '<p>Aucune commande en cours actuellement.</p>';
}
 ?>
