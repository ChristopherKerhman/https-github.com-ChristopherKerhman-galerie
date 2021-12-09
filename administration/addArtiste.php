<?php include 'administration/securite.php';
$requetteSQL = "SELECT `idArtiste`, `nomArtiste`, `prenomArtiste`, `Speudo`, `photoIdentiter`, `valide`
FROM `artistes`";
$prepare = [];
$readArtiste = new readDB($requetteSQL, $prepare);
$dataArtiste = $readArtiste->read();
?>
<h3>Liste des artistes valider</h3>
<ul>
  <?php
    foreach ($dataArtiste as $key) {
      if ($key['valide'] == 1) {
      echo '<li class="ligne">Fiche de : '.$key['Speudo'].' - Identiter : '.$key['prenomArtiste'].' '.$key['nomArtiste'].'
      <form action="CUD/Update/validerArtiste.php" method="post">
        <input type="hidden" name="valide" value="0">
        <input type="hidden" name="idArtiste" value="'.$key['idArtiste'].'">
        <button class="buttonAdmin" type="submit" name="button">Dévalider</button>
      </form>
      </li>';
      }
    }
   ?>
</ul>

<h3>Liste des artistes non valide</h3>
<ul>
  <?php
    foreach ($dataArtiste as $key) {
      if ($key['valide'] == 0) {
          echo '<li class="ligne">Fiche de : '.$key['Speudo'].' - Identiter : '.$key['prenomArtiste'].' '.$key['nomArtiste'].'
          <form action="CUD/Update/validerArtiste.php" method="post">
            <input type="hidden" name="valide" value="1">
            <input type="hidden" name="idArtiste" value="'.$key['idArtiste'].'">
            <button class="buttonAdmin" type="submit" name="button">Valider</button>
          </form>
          </li>';
      }
    }
   ?>
</ul>
<div id="VERROU">
  <button v-if="!lock" class="buttonAdmin" type="button" name="button" v-on:click="lock = true">Nouvelle artiste ?</button>
  <button v-else class="buttonAdmin" type="button" name="button" v-on:click="lock = false">Réduire</button>

  <div v-if="lock">
    <?php include 'formulaires/addArtiste.php'; ?>
  </div>
</div>
<script>
  const VERROU = Vue.createApp({
    data () {
      return {
      lock: false
      }
    }
  })
  VERROU.mount('#VERROU')
</script>
