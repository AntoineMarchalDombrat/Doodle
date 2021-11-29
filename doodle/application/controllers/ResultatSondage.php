<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResultatSondage extends CI_Controller {

	public function index(){

	}
	public function resultat($cle){
		$this->load->model('ResultatSondageModel');
		$this->load->model('RepondreSondageModel');

		$titre=$this->RepondreSondageModel->SelectTitre($cle);
		foreach ($titre as $key) {
			echo "<h1>Résultat du Sondage : $key->titre </h1> <br>";;
		}

		$nb_participant=$this->ResultatSondageModel->NombreParticipant($cle);

		$ListeParticipant=$this->ResultatSondageModel->ListeParticipant($cle);
		$data=array('ListeParticipant'=>$ListeParticipant);
		
		if (!empty($ListeParticipant[0]->idPer)){
			$idRef=$ListeParticipant[0]->idPer;

			//l'ensemble des disponibilité d'un participant
			$DispoRef=$this->ResultatSondageModel->DataReponse($cle,$idRef);

			//Le numéro de la disponibilité qui est en cvours de verif
			$numerodispo = 0;

			//on parcourt chaque disponibilité de l'utilisateur de ref
			echo "<p>Voici l'ensemble des créneaux horaires durant lesquels les répondants sont tous disponibles : </p>";
			foreach ($DispoRef as $dispo){
				$nbpersonnedispopourcettedate = 0;
				$numerodispo++;

				//on verifie pour chaque participant cette disponibilité

				foreach ($ListeParticipant as $id){
						$nbpersonnedispopourcettedate++;

						if ($this->ResultatSondageModel->CheckDispo($cle,$id->idPer,$dispo->heureDebut,$dispo->heureFin,$dispo->jour)){
							if($nbpersonnedispopourcettedate==$nb_participant){
								$heure_debut_2=new DateTime($dispo->heureDebut);
								$heure_debut=$heure_debut_2->format('H:i');
								$heure_fin_2=new DateTime($dispo->heureFin);
								$heure_fin=$heure_fin_2->format('H:i');
								setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
								$jour=$dispo->jour;
								$jour_2=strftime('%A %d %B %Y', strtotime($jour));
							echo "<h4>$jour_2 :</h4> $heure_debut-$heure_fin";
							}
						}
				 }
			}


		}else {
			echo "Pas de résultats, personne n'a répondu au sondage";
		}

		$this->load->view('templates/header');
		$this->load->view('templates/footer2');

	}
}
