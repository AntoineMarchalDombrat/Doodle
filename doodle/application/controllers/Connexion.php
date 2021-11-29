<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Connexion extends CI_Controller {

	public function index(){
		$this->load->model('ConnexionModel');

		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$login =htmlspecialchars($this->input->post('login'));
			$mdp = htmlspecialchars($this->input->post('mdp'));
			$mdp=sha1($mdp);
			$verif=$this->ConnexionModel->verifConnexion($login, $mdp);

		if ($verif==1){
			$_SESSION["connecte"]=2;
			$_SESSION["login"]=$login;
			header("location:Home");
		} else {
				$erreur = "Mauvais login ou mauvais mot de passe";
		}
		if (isset($erreur)){
				echo '<font color="red">' .$erreur. "</font>";
			 }

		}

		$this->load->view('templates/header');
		$this->load->view('templates/retourMenu');
		$this->load->view('connexion_message');
	}

}
