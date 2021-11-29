<?php

class ConnexionModel extends CI_Model{

	public function __construct(){
        $this->load->database();
  }

	public function verifConnexion($login, $mdp){

      	$this->db->select('mdp')->from('Compte');
				$this->db->where('login',$login);
				$this->db->where('mdp',$mdp);

        $query=$this->db->get();
        return $query->num_rows();
	}

}
