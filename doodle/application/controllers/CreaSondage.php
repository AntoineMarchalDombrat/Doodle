<?php
session_start();

defined('BASEPATH') OR exit('No direct script access allowed');

class CreaSondage extends CI_Controller {

  public function index(){
    if(empty($_SESSION["connecte"]) || $_SESSION["connecte"]==1) {
      $this->load->view('templates/header');
      $this->load->view('home_message_nonConnecter');
    } else {
      header("location:CreaSondage/traitement");
    }

  }
  public function traitement(){
    $this->load->model('CreaSondageModel');

    $data['nbJour']=$this->input->post('nombreJour');

    if (empty($check)) $check="";


    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

      $button=$this->input->post('button');


      $titre = htmlspecialchars($this->input->post('titre'));
      $lieu = htmlspecialchars($this->input->post('lieu'));
      $description = htmlspecialchars($this->input->post('description'));

      if ($button=="ajouter") {
        $data['titre']=$titre;
        $data['lieu']=$lieu;
        $data['description']=$description;
      }

      $clef=sha1(time());
      $_SESSION['clef']=$clef;


      if ($button=="Créer"){
        $dDay=date('Y-m-d');
        $toutEstBon=0;
        for ($j=0; $j < $data['nbJour']; $j++) {
          $jour= $this->input->post("jour'$j'");
          $mouton=$j+1;
          $heure_debut = $this->input->post("heure_debut'$j'");
          $heure_fin = $this->input->post("heure_fin'$j'");
          if (!empty($jour) && !empty($heure_debut) && !empty($heure_fin)){
            if ($jour>$dDay){
              for ($c=$mouton; $c < $data['nbJour']; $c++) {
                if ($jour==$this->input->post("jour'$c'")){
                  if ($heure_debut==$this->input->post("heure_debut'$c'")) {
                    if($heure_fin==$this->input->post("heure_fin'$c'")){
                      $erreur="Erreur : Vous ne pouvez pas renseigner plusieurs fois la même date avec les mêmes heures";
                    }
                  }
                }
              }
              if ($heure_debut<$heure_fin){
                $toutEstBon++;
              } else {
                $erreur="Erreur : Vous ne pouvez pas renseigner une heure de fin avant l'heure de début.";
              }
            } else {
              $erreur="Erreur : Vous ne pouvez pas renseigner une date qui est déjà passé.";
            }
          }
        }

        if(!empty($titre) && !empty($lieu) && !empty($description) && !empty($_SESSION["login"]) && !empty($clef) && !empty($data['nbJour']) &&  $toutEstBon==$data['nbJour'] && empty($erreur)){
          $data1=array(
            'clé'=>$clef,
            'login'=>$_SESSION["login"],
            'titre'=>$titre,
            'lieu'=> $lieu,
            'description'=>$description
          );
          if ($this->CreaSondageModel->InsertSondage($data1)){
            $check="good";
          } else {
            $erreur="Error 1";
          }
          for ($i=0; $i < $data['nbJour'] && $check=="good"; $i++) {
            $jour= $this->input->post("jour'$i'");
            $heure_debut = $this->input->post("heure_debut'$i'");
            $heure_fin = $this->input->post("heure_fin'$i'");

            $data2=array(
            'jour'=>$jour,
            'heureDebut'=>$heure_debut,
            'heureFin'=>$heure_fin,
            'clé'=>$clef
            );
            if ($this->CreaSondageModel->InsertDispo($data2)){
              $check="good";
            } else {
              $check="not good";
              $erreur="Error 2";
            }

          }

        } else if (empty($erreur)) {
          $erreur = "Erreur : Vous n'avez pas remplis tous les champs du formulaire.";
        }
        if (isset($erreur)){
          $data['titre']=$titre;
          $data['lieu']=$lieu;
          $data['description']=$description;

          echo '<font color="red">' .$erreur. "</font>";
        }
        if ($check=="good") {

          header("location:resultat");
        }
      }
    }
     if ($check!="good"){
       $this->load->view('templates/header');
       $this->load->view('templates/retourMenu');
       $this->load->view('creation_sondage_message',$data);
       $this->load->view('templates/footer');
     }
  }

  public function resultat() {

    $data['clef']=$_SESSION['clef'];
    $this->load->view('templates/header');
    $this->load->view('templates/retourMenu');
    $this->load->view('fin_creation_sondage_message',$data);
  }

}
