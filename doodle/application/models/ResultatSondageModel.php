<?php

class ResultatSondageModel extends CI_Model{

	public function __construct(){
        $this->load->database();
  }


    public function NombreParticipant($cle){
    $this->db->select('*')->from('Participant');
    $this->db->where('clé',$cle);

  	$query=$this->db->get();
    return $query->num_rows();

    }

    public function ListeParticipant($cle){
    $this->db->select('idPer')->from('Participant');
    $this->db->where('clé',$cle);

  	$query=$this->db->get();
    return $query->result();
    }

    public function DataReponse ($cle,$id){
    $this->db->select('*')->from('Reponse');
    $this->db->where('clé',$cle);
    $this->db->where('idPer',$id);

  	$query=$this->db->get();
    return $query->result();

    }


    public function CheckDispo($cle,$id,$heuredebut,$heurefin,$jour){
    $this->db->select('*')->from('Reponse');
    $this->db->where('clé',$cle);
    $this->db->where('idPer',$id);
    $this->db->where('heureDebut',$heuredebut);
    $this->db->where('heureFin',$heurefin);
    $this->db->where('jour',$jour);
    $query=$this->db->get();
    return $query->num_rows();

    }

		public function SelectReponse($clef){
			$this->db->select('*')->from('Reponse');
	    $this->db->where('clé',$clef);

			$query=$this->db->get();
	    return $query->result();
		}



}
