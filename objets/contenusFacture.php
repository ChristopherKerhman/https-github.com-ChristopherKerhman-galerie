<?php
class contenusFacture {
  private $idCommande;
   public function __construct ($idCommande) {
     $this->idCommande = $idCommande;
   }
   public function affichageDetails() {
     $SQL = "SELECT `idArticle`, `idDevis`, `prixHT`, `oeuvres`.`idOeuvre`, `nomOeuvre`
     FROM `detailCommande`
     INNER JOIN `oeuvres` ON `oeuvres`.`idOeuvre` = `detailCommande`.`idOeuvre`
     WHERE `idDevis` = :idDevis";
     $pre = [['prep'=> ':idDevis', 'variable' => $this->idCommande]];
     $readDevis = new readDB($SQL, $pre);
     $data = $readDevis->read();
     foreach ($data as $key) {
      $prixTTC = $key['prixHT'] * 1.2;
       echo '<ul>
            <li>Nom Oeuvre : '.$key['nomOeuvre'].'</li>
            <li>Prix unitaire HT : '.$key['prixHT'].'</li>
            <li>Prix unitaire TTC : '.round($prixTTC, 2).'</li>
            </ul>';
     }
   }
}
