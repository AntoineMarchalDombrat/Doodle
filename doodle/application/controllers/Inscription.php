<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Inscription extends CI_Controller {



	public function index()
	{
		$this->load->model('InscriptionModel');










		if ($_SERVER['REQUEST_METHOD'] == 'POST'){

					$login =htmlspecialchars($this->input->post('login'));
					$mdp = htmlspecialchars($this->input->post('mdp'));
					$prenom = htmlspecialchars($this->input->post('prenom'));
					$nom = htmlspecialchars($this->input->post('nom'));
					$mail = htmlspecialchars($this->input->post('mail'));


   			if(!empty($login) && !empty($mdp) && !empty($prenom) && !empty($nom) && !empty($mail)){


   				if (filter_var($mail,FILTER_VALIDATE_EMAIL)){

						$data=array(
			                'login'=>$login,
			                'mdp'=> sha1($mdp),
			                'nom'=>$nom,
			                'prenom'=>$prenom,
			                'email'=>$mail
			            );
	                  //on envoie les données dans la database
	   					if($this->InscriptionModel->InsertionCompte($data)){
								$_SESSION["connecte"] = 2;
								$_SESSION["login"]=$login;
								header("location:Home");
							}

	   			}else{
	   				$erreur ="Votre adresse mail n'est pas valide";
   				}

   		} else{
   			$erreur = "Tous les champs du formulaire doivent être remplis";
   		}
   		if (isset($erreur)){
         	echo '<font color="red">' .$erreur. "</font>";
      }
   	}


		$this->load->view('templates/header');
		$this->load->view('templates/retourMenu');
		$this->load->view('inscription_message');

		}
}
