<?php

class HomeConnecteModel extends CI_Model{

	public function __construct(){
        $this->load->database();
  }

  public function SondageEnCours($login){
     $this->db->select('*')->from('Sondage');
     $this->db->where('login',$login);
     $this->db->where('ouvert',1);
  	 $query=$this->db->get();
     return $query->result();
  }

  public function NbSondageEnCours($login){
     $this->db->select('*')->from('Sondage');
     $this->db->where('login',$login);
     $this->db->where('ouvert',1);
     $query=$this->db->get();
     return $query->num_rows();
  }



	public function SondageData($cle){
	     $this->db->select('*')->from('Sondage');
	     $this->db->where('clé',$cle);

	     $query=$this->db->get();
	     return $query->result();
	 }


  public function FermerSondage($data,$cle){
        $this->db->where('clé',$cle);
        return $this->db->update('Sondage',$data);
  }


  public function SondageFerme($login){
     $this->db->select('*')->from('Sondage');
     $this->db->where('login',$login);
     $this->db->where('ouvert',0);
     $query=$this->db->get();
     return $query->result();
  }

}

?>
