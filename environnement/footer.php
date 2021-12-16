<footer>
  <h3>Projet réalisé pour le portfolio de monsieur Calmes Christophe</h3>
  <a class="lienSite" href="https://cpp.christophe.kerman.go.yj.fr/monProjet">Lien vers son portfolio</a>
  <div id="RGPD">
    <p v-if="affichage != 1">Ce site ne produit aucun cookie de tracking, uniquement un cookie de session sans aucune information personnelle vous concernant.</p>
    <button v-if="affichage != 1" class="buttonStandard center" type="button" name="button" v-on:click="affichage = 1">Ok</button>
  </div>
</footer>
</body>

<script>
  const RGPD = Vue.createApp({
    data () {
      return {
      affichage: <?php if (isset($_SESSION['idUser'])) {echo $_SESSION['valide'];} else { echo 0;} ?>
      }
    }
  })
  RGPD.mount('#RGPD')
</script>
</html>
<?php $conn = null; ?>
