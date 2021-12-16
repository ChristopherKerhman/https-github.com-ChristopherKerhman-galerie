<?php
include 'stockage/statuts.php';
include 'securite/securiterCreateur.php';
function affichageCommande($key, $statuts, $idNav) {
  echo '<li>N° de commande : LNG '.$key['idCommande'].'</li>';
  echo '<li>Prenom et nom du destinataire : '.$key['prenom'].' '.$key['nom'].'</li>';
  echo '<li>Statuts actuel de la commande : '.$statuts[$key['statutsCommande']]['etape'].'</li>';
  echo '
    <form action="CUD/Update/traitementCommande.php" method="post">
      <input type="hidden" name="idCommande" value="'.$key['idCommande'].'">
      <input type="hidden" name="idNav" value="'.$idNav.'">
      <select class="inputFormulaire" name="statutsCommande">';
        foreach ($statuts as $index) {
        echo '<option value="'.$index['etat'].'">'.$index['etape'].'</option>';
        }
      echo '</select>
      <button class="buttonAdmin" type="submit" name="button">Modifier</button>
    </form>';
}
function affichageArchive($key, $statuts) {
  echo '<li>N° de commande : LNG '.$key['idCommande'].'</li>';
  echo '<li>Prenom et nom du destinataire : '.$key['prenom'].' '.$key['nom'].'</li>';
  echo '<li>Statuts actuel de la commande : '.$statuts[$key['statutsCommande']]['etape'].'</li>';
}
$requetteSQL = "SELECT `idCommande`, `idClient`, `statutsCommande`, `nom`, `prenom` FROM `commandes`
INNER JOIN `users` ON `idClient` = `idUser`
WHERE `statutsCommande` >= 2 AND `statutsCommande` <=4";
$prepare = [];
$readCommande = new readDB($requetteSQL, $prepare);
$dataCommande = $readCommande->read();
echo '<ul>';
 ?>
<h3>Commandes a livrer</h3>
<?php
echo '<ul>';
foreach ($dataCommande as $key) {
  if ($key['statutsCommande'] == 2) {
    affichageCommande($key, $statuts, $idNav);
  }
}
echo '</ul>';
 ?>
 <h3>Commandes receptionnées par le client</h3>
 <?php
 echo '<ul>';
 foreach ($dataCommande as $key) {
   if ($key['statutsCommande'] == 3) {
    affichageCommande($key, $statuts, $idNav);
   }
 }
 echo '</ul>';
  ?>
<div id="VERROU">
  <div v-if="affichage">
    <h3>Archive</h3>
    <?php
    echo '<ul>';
    foreach ($dataCommande as $key) {
      if ($key['statutsCommande'] == 4) {
       affichageArchive($key, $statuts);
      }
    }
    echo '</ul>';
     ?>
  </div>
  <div v-else>
      <button class="buttonAdmin" type="button" name="button" v-on:click="affichage = true">Voir les archives</button>
  </div>

</div>
  <script>
    const VERROU = Vue.createApp({
      data () {
        return {
        affichage: false
        }
      }
    })
    VERROU.mount('#VERROU')
  </script>
