<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aula8 extends CI_Controller {

	public function index(){
		/*$dados = array (
					"nome"   => "Rafael de Oliveira",
					"cidade" => "Ponta Grossa"
				);

		$this->session->set_userdata($dados);
		$this->session->set_userdata("nome2", "Malandro de Oliveira");*/

		/*$nome2 = $this->session->userdata("nome2");
		$cidade = $this->session->userdata("cidade");
		echo $nome2;*/

		$data = $this->session->all_userdata();

		echo "<pre>";
		print_r($data);
	}

}