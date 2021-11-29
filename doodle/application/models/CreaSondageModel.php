<?php

class CreaSondageModel extends CI_Model{

  public function __construct(){
      $this->load->database();
  }
  public function InsertSondage($data1){

      return $this->db->insert('Sondage', $data1);
  }

  public function InsertDispo($data2){

      return $this->db->insert('Dispo', $data2);
  }
}
