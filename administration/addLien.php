<?php
include 'administration/securite.php';
$yes = ['non', 'oui'];
$admin = ['Visiteur', 'Utilisateur', 'Createur', 'Administrateur' ];
 ?>
 <form action="CUD/Create/lien.php" method="post">
 <label for="nom"> Nom Lien</label>
 <input id="nomLien" class="inputFormulaire" type="text" name="nomLien">
 <label for="chemin">Chemin lien</label>
 <input id="chemin" class="inputFormulaire" type="text" name="cheminNav">
 <label for="levelAdmi">Niveau d\'administration</label>
 <select class="inputFormulaire" name="levelAdmi">
   <?php
 for ($i=0; $i < count($admin)  ; $i++) {
     echo '<option value="'.$i.'">'.$admin[$i].'</option>';
   }
    ?>
 </select>
 <label for="ordre">ordre</label>
 <input id="ordre" class="inputFormulaireNumber" type="number" min="0" max="10" name="ordre" value="'.$key['ordre'].'">
 <button class="buttonAdmin" type="submit" name="button">Créer</button>
 </form>

<?php
//print_r($_SESSION);
// Recherche des liens de la navigation
// objets et fonction nécessaire au fonctionnement de la log
$requetteSQL = "SELECT `idNav`, `nomLien`, `cheminNav`, `valide`, `levelAdmi`, `ordre` FROM `nav` ORDER BY `levelAdmi` ASC";
$prepare = [];
$dataNav = new readDB($requetteSQL, $prepare);
$dataLien = $dataNav->read();
?>
<ul>
  <?php

    foreach ($dataLien as $key) {

      echo '<li>
      Id menu :'.$key['idNav'].'- Nom '.$key['nomLien'].'- chemin ='.$key['cheminNav'].'- Valide ?'.$yes[$key['valide']].'-'.$admin[$key['levelAdmi']].'- Ordre'.$key['ordre'].'
      </li>';
      if ($key['levelAdmi'] == 3) {
        echo'<li>
        <form action="CUD/Delette/lien.php" method="post">
          <input type="hidden" name="idNav" value="'.$key['idNav'].'">
          <button class="buttonAdmin" type="submit" name="button">Supprimer</button>
        </form>
        <form action="CUD/Update/lien.php" method="post">
          <input type="hidden" name="idNav" value="'.$key['idNav'].'">
          <label for="nomLien">Nom Lien</label>
          <input id="nomLien" class="inputFormulaire" type="text" name="nomLien" value="'.$key['nomLien'].'">
          <label for="Chemin">Chemin</label>
          <input id="Chemin" class="inputFormulaire" type="text" name="cheminNav" value="'.$key['cheminNav'].'">
          <label for="valide">Valide ?</label>
          <select class="inputFormulaire" name="valide">
            <option value="0">Non</option>
            <option value="1" selected>Oui</option>
          </select>
          <label for="levelAdmi">Niveau d\'administration</label>
          <select class="inputFormulaire" name="levelAdmi">
            <option value="0">Visiteur</option>
            <option value="1">Utilisateur</option>
            <option value="2">Createur</option>
            <option value="3" selected>Administrateur</option>
          </select>
          <label for="ordre">ordre</label>
          <input id="ordre" class="inputFormulaireNumber" type="number" min="0" max="10" name="ordre" value="'.$key['ordre'].'">
          <button class="buttonAdmin" type="submit" name="button">Modifier</button>
          </form>
          </li>
        ';
      } else {
        echo'<li>
        <form action="CUD/Delette/lien.php" method="post">
          <input type="hidden" name="idNav" value="'.$key['idNav'].'">
          <button class="buttonAdmin" type="submit" name="button">Supprimer</button>
        </form>
        <form action="CUD/Update/lien.php" method="post">
          <input type="hidden" name="idNav" value="'.$key['idNav'].'">
          <label for="nomLien">Nom Lien</label>
          <input id="nomLien" class="inputFormulaire" type="text" name="nomLien" value="'.$key['nomLien'].'">
          <label for="Chemin">Chemin</label>
          <input id="Chemin" class="inputFormulaire" type="text" name="cheminNav" value="'.$key['cheminNav'].'">
          <label for="valide">Valide ?</label>
          <select class="inputFormulaire" name="valide">
            <option value="0">Non</option>
            <option value="1" selected>Oui</option>
          </select>
          <label for="levelAdmi">Niveau d\'administration</label>
          <select class="inputFormulaire" name="levelAdmi">
            <option value="0">Visiteur</option>
            <option value="1">Utilisateur</option>
            <option value="2">Createur</option>
            <option value="3">Administrateur</option>
          </select>
          <label for="ordre">ordre</label>
          <input id="ordre" class="inputFormulaireNumber" type="number" min="0" max="10" name="ordre" value="'.$key['ordre'].'">
        <button class="buttonAdmin" type="submit" name="button">Modifier</button>
        </form>
        </li>';
      }
    }
   ?>
</ul>
