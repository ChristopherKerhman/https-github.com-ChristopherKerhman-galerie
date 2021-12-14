<?php
class oeuvre {
  private $idOeuvre;
  private $nomOeuvre;
  private $nomFichier;
  private $prixOeuvre;
  private $createurOeuvre;
  private $cool;
  private $Speudo;
  public $idNav;

  public function __construct($key, $idNav) {
    $this->idOeuvre = $key['idOeuvre'];
    $this->nomOeuvre = $key['nomOeuvre'];
    $this->nomFichier = $key['nomFichier'];
    $this->prixOeuvre = $key['prixOeuvre'];
    $this->createurOeuvre = $key['createurOeuvre'];
    $this->cool = $key['cool'];
    $this->Speudo = $key['Speudo'];
    $this->idNav = $idNav;
    $this->prixTTC = round((($this->prixOeuvre + $this->cool) * 1.2), 2);
  }
  public function affichageGallery () {

    echo '<div class="item">
    <figure>
           <img class="hauteurGalleryA" src="galerieWeb/'.$this->nomFichier.'" alt="'.$this->nomOeuvre.' width="100em" />
             <figcaption>
             <ul>
             <li><h4 id="titreOeuvre">'.$this->nomOeuvre.'</h4></li>
             <li>Artiste : '.$this->Speudo.'</li>
             <li>Prix : '.$this->prixTTC.' € TTC</li>
             <li>Popularité : '.$this->cool.'</li>
             <li>
             <form  action="CUD/Update/cool.php" method="post">
               <input type="hidden" name="idOeuvre" value="'.$this->idOeuvre.'">
               <input type="hidden" name="idNav" value="'.$this->idNav.'">
               <button class="buttonStandard" type="submit" name="button">+1 € à + '.$this->cool.' €</button>
             </form>
             <li>
             <form  action="commerce/commander.php" method="post">
               <input type="hidden" name="idOeuvre" value="'.$this->idOeuvre.'">
               <input type="hidden" name="idNav" value="'.$this->idNav.'">
               <button class="buttonStandard" type="submit" name="button">Commander</button>
             </form>
             </li>
             </li></ul>
             </figcaption>
         </figure>
         </div>';
  }

  public function affichageVisiteur () {
    echo '<div class="item">
    <figure>
           <img class="hauteurGalleryA" src="galerieWeb/'.$this->nomFichier.'" alt="'.$this->nomOeuvre.' width="100em" />
             <figcaption>
             <ul>
             <li><h4 id="titreOeuvre">'.$this->nomOeuvre.'</h4></li>
             <li>Artiste : '.$this->Speudo.'</li>
             <li>Prix : '.$this->prixTTC.' € TTC</li>
             <li>Popularité : '.$this->cool.'</li>
             </ul>
             </figcaption>
         </figure>
         </div>';
  }
}

 ?>
