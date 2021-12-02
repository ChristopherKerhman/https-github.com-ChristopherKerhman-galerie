<?php
session_start();
$vueJSCDN = 'node_modules/vue/dist/vue.global.prod.js';
 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/master.css">
    <script src="<?php echo $vueJSCDN; ?>"></script>
    <title>Lezards Numeriques</title>
  </head>
  <body>
  <header>
    <h1>Lézards Numériques</h1>
      <h2>Une galerie d'arts numériques</h2>
        <nav>
          <ul class="listNav">
            <li class="lienSite">Truc</li>
            <li class="lienSite">Truc</li>
          </ul>
        </nav>
  </header>
