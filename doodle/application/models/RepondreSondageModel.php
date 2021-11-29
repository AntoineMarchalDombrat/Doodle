<?php

class RepondreSondageModel extends CI_Model{

  public function __construct(){
      $this->load->database();
  }

  public function OuvertSondage($clef){
    $this->db->select('ouvert')->from('Sondage')->where('clé',$clef);

    $query=$this->db->get();
    return $query->result();
  }

  public function RecupDispo($cle){
  	$this->db->select('*')->from('Dispo');
  	$this->db->where('clé',$cle);
  	$query=$this->db->get();
    return $query->result();
  }

  public function SelectTitre($clef){
    $this->db->select('*')->from('Sondage')->where('clé',$clef);
    $query=$this->db->get();
    return $query->result();
  }

  public function IdParticipant(){
    $this->db->select('*')->from('Participant');

    $query=$this->db->get();
    return $query->num_rows();
  }

  public function InsertParticipant($data){
      return $this->db->insert('Participant', $data);
  }

  public function InsertReponse($data){
    return $this->db->insert('Reponse', $data);
  }

}
