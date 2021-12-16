<?php
class monoOeuvre {
  private $idOeuvre;

  public function __construct($idOeuvre) {
    $this->idOeuvre = $idOeuvre;
  }
  public function readOeuvre() {
    $SQL = "SELECT `idOeuvre`, `nomOeuvre`, `description`, `nomFichier`, `prixOeuvre`, `createurOeuvre`, `cool`
    FROM `oeuvres`
    WHERE `idOeuvre` = :idOeuvre AND `valide` = 1";
    $pre = [['prep'=> ':idOeuvre', 'variable' => $this->idOeuvre]];
    $dataOeuvre = new readDB($SQL, $pre);
    return $dataOeuvre->read();
  }
  public function affichageOeuvre($dataMonoOeuvre) {
    $prixHT = ($dataMonoOeuvre[0]['prixOeuvre'] + $dataMonoOeuvre[0]['cool']);
    $prixTTC = $prixHT * 1.2;
    echo '<div class="couloirGallery"><h3>'.$dataMonoOeuvre[0]['nomOeuvre'].'</h3>';
    echo '<figure>
           <img class="hauteurGalleryM" src="galerieWeb/'.$dataMonoOeuvre[0]['nomFichier'].'" alt="'.$dataMonoOeuvre[0]['nomOeuvre'].'" />
             <figcaption>
             <ul>
             <strong>
             <li class="center">Popularité de l\'oeuvre : '.$dataMonoOeuvre[0]['cool'].'</li>
             <li>Note sur l\'oeuvre : '.$dataMonoOeuvre[0]['description'].'</li>
             <li>Prix actuel de l\'oeuvre HT : '.$prixHT.' €</li>
             <li>Prix actuel de l\'oeuvre HT : '.round($prixTTC, 2).' €</li>
             </strong>
             </ul>
             </figcaption>
          </figure>';
    echo '</div>';
  }
  public function commander ($dataMonoOeuvre) {
    echo ' <form  action="commerce/commander.php" method="post">
       <input type="hidden" name="idOeuvre" value="'.$dataMonoOeuvre[0]['idOeuvre'].'">
       <input type="hidden" name="idNav" value="0">
       <button class="buttonStandard" type="submit" name="button">Commander</button>
     </form>';
  }
  public function populaire ($dataMonoOeuvre) {
    echo '<form  action="CUD/Update/cool.php" method="post">
      <input type="hidden" name="idOeuvre" value="'.$dataMonoOeuvre[0]['idOeuvre'].'">
      <input type="hidden" name="idNav" value="0">
      <button class="buttonStandard" type="submit" name="button">Populaire +1</button>
    </form>';
  }
}
