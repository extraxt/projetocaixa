<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Login_Model", "LoginM");
	}

	public function index()
	{
		$this->layout="login";

		$this->load->view("login");
	}

	public function logar()
	{
		$usuario = $this->input->post("usuario");
		$senha   = $this->input->post("senha");

		$resultado = $this->LoginM->procurar_usuario($usuario, $senha);


		//VERIFICAÇÃO SE OS DADOS VIERAM
		$erros    = FALSE;
		$mensagem = null;
		
		if(!$usuario){
			$erros = TRUE;
			$mensagem .= "Informe o usuário\n";
		}

		if(!$senha){
			$erros = TRUE;
			$mensagem .= "Informe a senha\n";
		}		

		if($erros){
			$this->session->set_flashdata("erro", nl2br($mensagem));
			redirect("login");
		} else {
			if($resultado){
				$this->session->set_userdata("id", $resultado[0]["idlogin"]);
				$this->session->set_userdata("nomeusuario", $resultado[0]["nomeusuario"]);
				redirect("lancamentos");
			} else {
				$this->session->set_flashdata("erro", "O acesso não é possível devido usuário ou senha incorretos.");
				redirect("login");
			}
		}
	}

	public function deslogar()
	{
		$this->session->sess_destroy();
		redirect(login);
	}
}