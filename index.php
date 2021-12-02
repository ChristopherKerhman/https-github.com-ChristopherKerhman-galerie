<?php include 'environnement/header.php' ?>
    <section>
      <?php if(isset($_GET['message'])){ echo filter($_GET['message']); } ?>
      <article>
        <?php
        if (isset($_GET['idNav'])) {
          $idNav = filter($_GET['idNav']);
          $requetteSQL = "SELECT  `cheminNav`
          FROM `nav` WHERE `idNav` = :idNav";
          $prepare = [['prep'=> ':idNav', 'variable' => $idNav]];
          $readNav = new readDB($requetteSQL, $prepare);
          $dataNav = $readNav->read();
        }
         ?>
         <?php
         if (empty($dataNav)) {
            include 'environement/corpsDeflaut.php';
         } else {
            include $dataNav[0]['cheminNav'];
         }
          ?>
      </article>
    </section>
<?php include 'environnement/footer.php' ?>
