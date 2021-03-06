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
    $this->prixHT =   $this->prixOeuvre + $this->cool;
    $this->prixTTC = round(($this->prixHT * 1.2), 2);
  }
  public function navigation () {
    $SQL = "SELECT `idNav`, `nomLien`, `cheminNav`, `valide`, `levelAdmi`
    FROM `nav`
    WHERE `valide` = 1 AND `levelAdmi` = :levelAdmi AND `centrale` = 1 AND `ordre` = 2";
    $pre = [['prep'=> ':levelAdmi', 'variable' => $_SESSION['role']]];
    $readLien = new readDB($SQL, $pre);
    $dataLien = $readLien->read();
    echo '<a class="navGallery" href="index.php?idNav='.$dataLien[0]['idNav'].'& idOeuvre='.$this->idOeuvre.'">'.$dataLien[0]['nomLien'].' '.$this->nomOeuvre.'  </a>';
  }
  public function affichageGallery () {
    echo '<div class="item">
    <figure>
           <img class="hauteurGalleryA" src="galerieWeb/'.$this->nomFichier.'" alt="'.$this->nomOeuvre.' width="100em" />
             <figcaption>
             <ul>
             <li><h4 id="titreOeuvre">'.$this->nomOeuvre.'</h4></li>
             <li>Artiste : '.$this->Speudo.'</li>
             <li class="prix">Prix : '.$this->prixTTC.' € TTC</li>
             <li>Popularité : '.$this->cool.'</li>
             <li>
             <form  action="CUD/Update/cool.php" method="post">
               <input type="hidden" name="idOeuvre" value="'.$this->idOeuvre.'">
               <input type="hidden" name="idNav" value="'.$this->idNav.'">
               <button class="buttonStandard" type="submit" name="button">Populaire +1</button>
             </form>
             <li>
             <form  action="commerce/commander.php" method="post">
               <input type="hidden" name="idOeuvre" value="'.$this->idOeuvre.'">
               <input type="hidden" name="idNav" value="'.$this->idNav.'">
               <button class="buttonStandard" type="submit" name="button">Commander</button>
             </form>
             </li>';
             // Compléter avec function navigation() ou  le code de fermeture :    echo'</li></ul></figcaption></figure></div>'; dans le fichier
  }

  public function affichageVisiteur () {
    echo '<div class="item">
    <figure>
           <img class="hauteurGalleryA" src="galerieWeb/'.$this->nomFichier.'" alt="'.$this->nomOeuvre.' width="100em" />
             <figcaption>
             <ul>
             <li><h4 id="titreOeuvre">'.$this->nomOeuvre.'</h4></li>
             <li>Artiste : '.$this->Speudo.'</li>
             <li class="prix">Prix : '.$this->prixTTC.' € TTC</li>
             <li>Popularité : '.$this->cool.'</li>
             </ul>
             </figcaption>
         </figure>
         </div>';
  }

}

 ?>
