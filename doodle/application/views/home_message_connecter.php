<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>

	<a class="pull-left" href="Deconnexion">Se déconnecter</a>

	<a class="pull-right" href="CreaSondage">Créer un sondage</a>

	<h2> Les sondages en cours : </h2>

	<?php
	foreach($result as $ligne){
		echo "<div>";
		echo "<h4>Titre : $ligne->titre</h4>";
		echo "https://dwarves.iut-fbleau.fr";
		echo site_url("/RepondreSondage/reponse/$ligne->clé");
		echo '<form action="" method="POST">
     	<button name="bouton" value="' .$ligne->clé. '">Fermer le sondage</button>
    	</form>';
		echo "<br>";
		echo "</div>";
    }


	?>
	<h2>Sondages fermés :</h2>
	<?php


	foreach($result2 as $ligne){
		echo "<div>";
		echo "<h4>Titre : $ligne->titre</h4>";
		echo "https://dwarves.iut-fbleau.fr";
		echo site_url("/RepondreSondage/reponse/$ligne->clé");
		echo '<form action="" method="POST">
     	<button name="button" value="' .$ligne->clé. '">Consulter les résultats</button>
    	</form>';
		echo "<br><br>";
		echo "</div>";
	}
	?>
	<br><br>


</body>
</html>
