<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
  <div>
    <h1>Sondage créé</h1>
    <p>Le sondage a bien été crée, voici le lien du sondage : <br>
      <?php
      echo "https://dwarves.iut-fbleau.fr";
      echo site_url("/RepondreSondage/reponse/$clef");
      ?><br><br><br>
      Vous pourrez également le retrouver sur votre page d'accueil.
    </p>
  </div>

</body>
