<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login_Model extends CI_Model
{
	public function procurar_usuario($usuario, $senha){
		$dados = array (
					"usuario" => $usuario,
					"senha"   => $senha
		);

		$this->db->select("idlogin, usuario, senha, nomeusuario");
		$this->db->where($dados);
		$this->db->from("login");
		RETURN $this->db->get()->result_array();
	}
}