<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Deconnexion extends CI_Controller {

  public function index() {
    $_SESSION["connecte"]=1;
    $this->load->view('templates/header');
    $this->load->view('home_message_nonConnecter');
  }
}
