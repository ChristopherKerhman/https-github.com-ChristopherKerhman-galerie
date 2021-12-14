<?php
include 'commerce/readCommande.php';
require 'objets/contenusCommande.php';
//Lire le devis du Client
$requetteSQL = "SELECT `idCommande`, `statutsCommande` FROM `commandes` WHERE `statutsCommande` = 0 AND `idClient` = :idClient";
$prepare = [['prep'=> ':idClient', 'variable' => $_SESSION['idUser']]];
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
//Lire les facture du client
$requetteSQL = "SELECT `idCommande`, `statutsCommande`, `prixHT`
FROM `commandes`
WHERE `statutsCommande` >= 1 AND `idClient` = idClient";
$prepare = [['prep'=> ':idClient', 'variable' => $_SESSION['idUser']]];
$facture = readCommande($requetteSQL, $prepare);
require 'objets/contenusFacture.php';
$statuts = [['etat' => 0, 'etape' => 'Devis'],
   ['etat' => 1, 'etape' => 'Facture'],
   ['etat' => 2, 'etape' => 'Livraison'],
   ['etat' => 3, 'etape' => 'Reception'],
   ['etat' => 4, 'etape' => 'Archiver'],];
foreach ($facture as $key) {
  // On affiche chaque élément de la facture
  $idCommande = $key['idCommande'];
  $dataDetail = new contenusFacture($idCommande);
  echo '<ul> numero de commande : LNG : '.$idCommande.'';

  $dataCommande = $dataDetail->affichageDetails();
  echo '<li>********</li>
    <li>Prix HT :'.$key['prixHT'].' €</li>
    <li>Prix TTC :'.$key['prixHT'] * 1.2.' €</li>
    <li>Statuts de la commande : '.$statuts[$key['statutsCommande']]['etape'].'</li>
  </ul>';

  //print_r($dataCommande);
}


 ?>
