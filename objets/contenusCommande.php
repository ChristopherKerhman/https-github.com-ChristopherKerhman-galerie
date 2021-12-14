<?php
class contenusDevis {
  private $Devis;
  private $details;
  private $statuts;
  private $totalCommande;
  public $idNav;

  public function __construct($commande, $details, $idNav, $totalCommande) {
    $this->commande = $commande;
    $this->details = $details;
    $this->statuts = [['etat' => 0, 'etape' => 'Devis'],
       ['etat' => 1, 'etape' => 'Facture'],
       ['etat' => 2, 'etape' => 'Livraison'],
       ['etat' => 3, 'etape' => 'Reception'],
       ['etat' => 4, 'etape' => 'Archiver'],];
       $this->idNav = $idNav;
       $this->totalCommande = $totalCommande[0]['total'];
  }
  public function affichageContenus() {
    $numeroCommande = $this->commande[0]['idCommande'];
    $etat = $this->commande[0]['statutsCommande'];
    echo '<article>
      <ul>
      <li><strong>Numéro de commande </strong> GLN'.$numeroCommande.'</li>';
    foreach ($this->details as $key) {
      echo '<li>n° article : '.$key['idOeuvre'].'</li>
            <li>Nom de l\'oeuvre : '.$key['nomOeuvre'].'</li>
            <li>Prix HT : '.$key['prixHT'].' €</li>
            <li>Prix TTC :'.round($key['prixHT'] * 1.2, 2).'. €</li>
            <li>
            <form action="CUD/Delette/articlePanier.php" method="post">
              <input type="hidden" name="idArticle" value="'.$key['idArticle'].'">
              <input type="hidden" name="idNav" value="'.$this->idNav.'">
              <button class="buttonStandard" type="submit" name="button">Effacer</button>
            </form>
            </li>';
          }
    echo '<li>****** Total '.$this->statuts[$etat]['etape'].'******</li>
    <li>Total HT : '.$this->totalCommande.' €</li>
    <li>Total TTC : '.round(  $this->totalCommande * 1.2, 2).' €</li></ul></article>';
  }
  public function signerDevis () {
    $numeroCommande = $this->commande[0]['idCommande'];
    echo '<form action="CUD/Update/panier.php" method="post">
      <input type="hidden" name="idCommande" value="'.$numeroCommande.'">
      <input type="hidden" name="idNav" value="'.$this->idNav.'">
      <button class="buttonStandard" type="submit" name="button">Valider le panier</button>
    </form>';
  }
}
