<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
	<?php
		$minutes_to_add = 30;
		if (empty($_POST["nom"])) $_POST["nom"]="";

		foreach ($titre as $key) {
			echo "<h1>Sondage : $key->titre </h1> <br>";
		}
		?>
		<p>Veuillez rentrer votre nom et cocher les demi-heures où vous êtes disponible afin que le créateur du sondage puisse connaître les disponibilités qui correspondent à tous le monde.</p>
		<form method="post">
			<input type="text" name="nom" value="<?php echo $_POST['nom']; ?>" placeholder="nom-prenom" maxlength="20">
				<?php
					$a=0;
					foreach($result as $ligne){
						$heure_debut_2=new DateTime($ligne->heureDebut);
						$heure_debut=$heure_debut_2->format('H:i');

						$heure_fin_2=new DateTime($ligne->heureFin);
						$heure_fin=$heure_fin_2->format('H:i');

						setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
						$jour=$ligne->jour;
						$jour_2=strftime('%A %d %B %Y', strtotime($jour));

						$heure_currAv=$heure_debut;
						$heure_currAp=$heure_debut;
						echo "<table>";
						echo "<tr>";
						echo "<td> <h4>$jour_2</h4> </td>";
						echo "<td>je suis disponible de</td>";
						echo "</tr>";

						while ($heure_currAp < $heure_fin) {

							$a++;
							$time = new DateTime($heure_currAp);
							$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

							$heure_currAp = $time->format('H:i');
							if (empty($ok)) $ok=1;
							if ($ok==1) {
								$ok++;
								echo "<tr>";
								echo "<td>$heure_debut - $heure_currAp</td>";
								echo "<td><input type=\"checkbox\" name=\"valide'$a'\" value='$a'></td>";
								echo "</tr>";
							} else if ($heure_currAp <= $heure_fin) {
								echo "<tr>";
								echo "<td>$heure_currAv - $heure_currAp</td>";
								echo "<td><input type=\"checkbox\" name=\"valide'$a'\" value='$a'></td>";
								echo "</tr>";
							} else {
								echo "<tr>";
								echo "<td>$heure_currAv - $heure_fin</td>";
								echo "<td><input type=\"checkbox\" name=\"valide'$a'\" value='$a'></td>";
								echo "</tr>";
							}
							$heure_currAv=$heure_currAp;
						}
						echo "</table><br>";

					}
				?>
			<br>
			<input type="submit" name="envoyer" value=Envoyé>

		</form>
