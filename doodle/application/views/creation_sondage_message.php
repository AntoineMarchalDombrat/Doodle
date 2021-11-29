<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (empty($titre)) $titre="";
if (empty($lieu)) $lieu="";
if (empty($description)) $description="";
if (empty($jour)) $jour="";
if (empty($heure_debut)) $heure_debut="";
if (empty($heure_fin)) $heure_fin="";

?>
    <div>
      <h1>Création d'un Sondage</h1>
      <form method="post">
        <input type="text" name="titre" placeholder="Titre" maxlength="20" <?php echo "value='$titre'"; ?> > <br>
        <input type="text" name="lieu" placeholder="Lieu" maxlength="20" <?php echo "value='$lieu'"; ?> > <br>
        <input type="text" name=" description" placeholder="description" maxlength="200" <?php echo "value='$description'"; ?> > <br>
        Nombre de jour : <input type="number" name="nombreJour" <?php echo "value='$nbJour'"; ?> min="1">
        <input type="submit" name="button" value="ajouter"> <br>
        <?php

        for ($i=0; $i < $nbJour  ; $i++) {
          if (isset($_POST["jour'$i'"])) $jour=$_POST["jour'$i'"];
          if (isset($_POST["heure_debut'$i'"])) $heure_debut=$_POST["heure_debut'$i'"];
          if (isset($_POST["heure_fin'$i'"])) $heure_fin=$_POST["heure_fin'$i'"];
          echo "Jour : <input type=\"date\" name=\"jour'$i'\" value='$jour'> <br>
          Heure de début : <input type=\"time\" name=\"heure_debut'$i'\" value='$heure_debut'>
          Heure de fin : <input type=\"time\" name=\"heure_fin'$i'\" value='$heure_fin'> <br><br><br>";

        }
        ?>
        <input type="submit" name="button" value="Créer">
      </form>
    </div>
