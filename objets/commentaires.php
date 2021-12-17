<?php
class commentaires {
  private $idOeuvre;
  private $idNav;
  private $idUser;
  private $role;

  public function __construct($idOeuvre, $idNav) {
    $this->idOeuvre = $idOeuvre;
    $this->idNav = $idNav;
    $this->idUser = $_SESSION['idUser'];
    $this->role = $_SESSION['role'];
  }
  public function redigerCommentaire () {
    echo '<form class="colonne" action="CUD/Create/commentaire.php" method="post">
      <input type="hidden" name="idOeuvre" value="'.$this->idOeuvre.'">
      <input type="hidden" name="idNav" value="'.$this->idNav.'">
      <textarea name="commentaire" rows="8" cols="80">
        Vous avez une remarque ?
      </textarea>
      <button type="submit" class="buttonStandard" name="button">Commenter</button>
    </form>';
  }
  public function readCommentaires () {
    // Pensez à mettre à 1 pour la partie modération.
    if ($this->role > 1) {
      $requetteSQL = "SELECT `idCommentaire`, `idoeuvre`, `login`, `commentaire`, `date`, `commentaires`.`valide`
      FROM `commentaires`
      INNER JOIN `users` ON `users`.`idUser` = `commentaires`.`idUser`
      WHERE `idoeuvre` = :idOeuvre";
    } else {
      $requetteSQL = "SELECT `idCommentaire`, `idoeuvre`, `login`, `commentaire`, `date`, `commentaires`.`valide`
      FROM `commentaires`
      INNER JOIN `users` ON `users`.`idUser` = `commentaires`.`idUser`
      WHERE `commentaires`.`valide` = 1 AND `idoeuvre` = :idOeuvre";
    }

    $prepare = [['prep'=> ':idOeuvre', 'variable' => $this->idOeuvre]];
    $dataCommentaires = new readDB($requetteSQL, $prepare);
    $data = $dataCommentaires->read();
    return $data;
  }
  public function affichageCommentaire ($data) {
    function dateBrassage ($data) {
          $date = $data;
          $Y = substr($date,0,4);
          $M = substr($date,5,2);
          $d = substr($date,8,2);
          $h = $M = substr($date,11,2);
          $m = $M = substr($date,14,2);
          $date =  $d.'/'.$M.'/'.$Y.' à '.$h.'h'.$m;
          return $date;
        }
    foreach ($data as $key) {
      echo 'Le '.dateBrassage($key['date']).' par '.$key['login'];
      echo '<p id="texte">'.$key['commentaire'].'</p>';
      if ($this->role > 1) {
        echo '</p><form  action="CUD/Update/valideCommentaire.php" method="post">
            <input type="hidden" name="idCommentaire" value="'.$key['idCommentaire'].'">
            <input type="hidden" name="idOeuvre" value="'.$this->idOeuvre.'">
            <input type="hidden" name="idNav" value="'.$this->idNav.'">
            <select class="inputFormulaire" name="valide">';
            if($key['valide'] == 0) {
              echo '<option value="0" selected>Non valide</option>
              <option value="1">Valide</option>';
            } else {
              echo '<option value="0">Non valide</option>
              <option value="1" selected>Valide</option>';
            }
            echo '</select>
            <button class="buttonStandard" type="submit" name="button">Administrer</button>
          </form>';
      }
    }
  }

}

 ?>
