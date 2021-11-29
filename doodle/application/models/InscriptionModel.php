<?php

class InscriptionModel extends CI_Model{

	public function __construct(){
        $this->load->database();
  }

	public function InsertionCompte($data){

      return $this->db->insert('Compte', $data);
	}




}
