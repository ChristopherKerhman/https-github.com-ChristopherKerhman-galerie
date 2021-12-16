<?php
$idCommande = filter($_GET['idCommande']);
$requetteSQL = "SELECT `prixHT` FROM `commandes`
WHERE `idClient` = :idClient AND `statutsCommande` = 1 AND `idCommande` = :idCommande";
$prepare = [['prep'=> ':idCommande', 'variable' => $idCommande],
            ['prep'=> ':idClient', 'variable' => $_SESSION['idUser']],];
$readCommande = new readDB($requetteSQL, $prepare);
$dataCommande = $readCommande->read();
$requetteSQL = "SELECT `idDevis`, `prixHT`, `nomOeuvre`
FROM `detailCommande`
INNER JOIN `oeuvres` ON `oeuvres`.`idOeuvre` = `detailCommande`.`idOeuvre`
WHERE `idDevis`= :idCommande";
$prepare = [['prep'=> ':idCommande', 'variable' => $idCommande]];
$readDetail = new readDB($requetteSQL, $prepare);
$dataDetail = $readDetail->read();
?>
<h3>Payer la facture </h3>
<article>
  <h4>N° LNG <?php echo $idCommande; ?></h4>
  <ul>
    <li><strong>Composer des oeuvres suivantes :</strong></li>
    <?php
      foreach ($dataDetail as $key) {
        $prixTTC = $key['prixHT'] * 1.2;
        echo '<li>'.$key['nomOeuvre'].'</li>
              <li>Prix TTC :'.round($prixTTC, 2).' €</li>';
      }
      $totalFactureTTC = $dataCommande[0]['prixHT'] * 1.2;
      echo '<li><strong>Prix HT : '.$dataCommande[0]['prixHT'].' €</strong></li>
            <li><strong>Prix TTC : '.round($totalFactureTTC, 2).' €</strong></li>';
     ?>

  </ul>
</article>
<article>
  <?php include 'formulaires/coordonnerBancaire.php'; ?>
</article>
