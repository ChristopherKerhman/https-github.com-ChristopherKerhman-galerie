<?php
class FicheUser {
  public $idUser;
  public $nom;
  public $prenom;
  public $login;
  public $valide;
  public $role;

  public function __construct($dataUser) {
    $this->idUser = $dataUser[0]['idUser'];
    $this->nom = $dataUser[0]['nom'];
    $this->prenom = $dataUser[0]['prenom'];
    $this->login = $dataUser[0]['login'];
    $this->valide = $dataUser[0]['valide'];
    $this->role = $dataUser[0]['role'];
  }
  public function fiche() {
    $role = ['Non valide', 'utilisateur', 'gestionnaire', 'administrateur'];
    $yes = ['Non', 'Oui'];
    echo '<ul>
    <li>Nom : '.$this->nom.'</li>
    <li>Prenom : '.$this->prenom.'</li>
    <li>Login : '.$this->login.'</li>
    <li>valide : '.$yes[$this->valide].'</li>
    <li>Role : '.$role[$this->role].'</li>
    </ul>';
  }
}
