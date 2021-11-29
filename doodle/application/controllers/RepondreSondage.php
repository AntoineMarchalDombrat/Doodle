<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RepondreSondage extends CI_Controller {

	public function index(){

	}
	public function reponse($cle){
		$this->load->model('RepondreSondageModel');

		$open=$this->RepondreSondageModel->OuvertSondage($cle);
		foreach ($open as $key) {
			$ouvert=$key->ouvert;
		}
		if ($ouvert==1){

			$result=$this->RepondreSondageModel->RecupDispo($cle);
			$titre=$this->RepondreSondageModel->SelectTitre($cle);
			$data=array(
				'result'=>$result,
				'titre'=>$titre
			);


			if ($_SERVER['REQUEST_METHOD'] == 'POST'){

				$nom=htmlspecialchars($this->input->post('nom'));
				if (!empty($nom)){

					$nb_participant=$this->RepondreSondageModel->IdParticipant();
					$id=$nb_participant+1;

					$gara = array(
						'idPer' => $id ,
						'nom' => $nom,
						'clé' => $cle
					);

					if ($this->RepondreSondageModel->InsertParticipant($gara)){
						$a=0;
						foreach ($result as $key) {
							$heure_debut=$key->heureDebut;
							$heure_fin=$key->heureFin;
							$jour=$key->jour;

							$heure_currAv=$heure_debut;
							$heure_currAp=$heure_debut;


							while ($heure_currAp < $heure_fin) {
								$minutes_to_add = 30;
								//	$jour=$key->jour;
								$a++;
								$time = new DateTime($heure_currAp);
								$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

								$heure_currAp = $time->format('H:i:s');
								if (empty($ok)) $ok=1;
								if ($ok==1) {
									$ok++;
									$cocher=$this->input->post("valide'$a'");
									if (!empty($cocher)){
										$gara2 = array(
											'jour' => $jour,
											'heureDebut' => $heure_debut,
											'heureFin' => $heure_currAp,
											'clé' => $cle ,
											'idPer' => $id
										);
										if ($this->RepondreSondageModel->InsertReponse($gara2)) {
											$np="good";
										} else {
											$erreur="Error 2";
										}
									}
								} else if ($heure_currAp <= $heure_fin) {
									$cocher=$this->input->post("valide'$a'");
									if (!empty($cocher)){
										$gara2 = array(
										'jour' => $jour,
										'heureDebut' => $heure_currAv,
										'heureFin' => $heure_currAp,
										'clé' => $cle ,
										'idPer' => $id
										);
										if ($this->RepondreSondageModel->InsertReponse($gara2)) {
											$np="good";
										} else{
											$erreur="Error 3";
										}
									}
								} else {
									$cocher=$this->input->post("valide'$a'");
									if (!empty($cocher)){
										$gara2 = array(
										'jour' => $jour,
										'heureDebut' => $heure_currAv,
										'heureFin' => $heure_fin,
										'clé' => $cle ,
										'idPer' => $id
										);
										if ($this->RepondreSondageModel->InsertReponse($gara2)) {
											$np="good";
										} else{
											$erreur="Error 4";
										}
									}
								}
								$heure_currAv=$heure_currAp;

							}
						}
					} else{
						$erreur="Error 1";
					}

					if(!empty($np)) {
						header("location:../msgReponse");

					}
				} else {

					$erreur="Erreur : Vous devez rentrer un nom";
				}
				if (isset($erreur)) echo '<font color="red">' .$erreur. "</font>";
			}

			$this->load->view('templates/header');
			$this->load->view('repondre_sondage_message',$data);
			$this->load->view('templates/footer');
		} else {
			$this->load->view('templates/header');
			$this->load->view('reponse_sondage_fermer_msg');
		}


	}

	public function msgReponse(){
		$this->load->view('templates/header');
		$this->load->view('fin_repondre_sondage');
	}


}
