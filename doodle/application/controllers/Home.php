<?php
session_start();
if(empty($_SESSION["connecte"])) $_SESSION["connecte"]=1;

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {
		$this->load->view('templates/header');

		if ($_SESSION["connecte"]==2){
			$this->load->model('HomeConnecteModel');


			$result=$this->HomeConnecteModel->SondageEnCours($_SESSION["login"]);
			$data=array('result'=>$result);

			$result2=$this->HomeConnecteModel->SondageFerme($_SESSION["login"]);
			$data2=array('result2'=>$result2);

			$data=array_replace($data,$data2);

			if (!empty($_POST['bouton'])){
				$data4['ouvert']=0;
				$clef=$_POST['bouton'];
				if($this->HomeConnecteModel->FermerSondage($data4,$clef)){
					header("location:ResultatSondage/resultat/$clef");
				}
			} else if (!empty($_POST['button'])) {
					$clef=$_POST['button'];
					header("location:ResultatSondage/resultat/$clef");
			} else {
				$this->load->view('home_message_connecter',$data);
				$this->load->view('templates/footer');
			}

		}else {

			$this->load->view('home_message_nonConnecter');
		}
	}

}
