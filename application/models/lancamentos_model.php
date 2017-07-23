<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Lancamentos_Model extends CI_Model
{
	public function postarcomuns($itens){
		$resultado = $this->db->insert("lancamentos", $itens);
		if ($resultado){
			return $itens;
		} else {
			return FALSE;
		}
	}

	public function postarcreditos($itens){
		$resultado = $this->db->insert("creditos", $itens);
		if ($resultado){
			return $itens;
		} else {
			return FALSE;
		}
	}

	public function postardebitos($itens){
		$resultado = $this->db->insert("debitos", $itens);
		if ($resultado){
			return $itens;
		} else {
			return FALSE;
		}
	}

	public function postardebitosclinica($itens){
		$resultado = $this->db->insert("debitosclinica", $itens);
		if ($resultado){
			return $itens;
		} else {
			return FALSE;
		}
	}

	public function atualizar_saldos($novosaldodentista, $novosaldoclinica){
		$this->db->where("idsaldo", 1, FALSE);
		$itens = array(
			"saldodentista" => $novosaldodentista,
			"saldoclinica"  => $novosaldoclinica
		);
		$resultado = $this->db->update("saldo", $itens);
		if($resultado){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function limpar_todas_tabelas(){
		$this->db->truncate('lancamentos');
		$this->db->truncate('creditos');
		$this->db->truncate('debitos');
		$this->db->truncate('debitosclinica');
	}

	public function pegarsaldos(){
		$this->db->select("saldodentista, saldoclinica");
		$this->db->from("saldo");
		return $this->db->get()->result();
	}

	public function pegarcomuns(){
		$this->db->select("idlancamentos, datadaficha, nomepac, valor, forma, taxacartao, taxacomissao");
		$this->db->from("lancamentos");
		return $this->db->get()->result();
	}

	public function pegarcreditos(){
		$this->db->select("idcreditos, datadaficha, valor, observacoes");
		$this->db->from("creditos");
		return $this->db->get()->result();
	}

	public function pegardebitos(){
		$this->db->select("iddebitos, datadaficha, valor, observacoes");
		$this->db->from("debitos");
		return $this->db->get()->result();
	}

	public function pegardebitosclinica(){
		$this->db->select("iddebitosclinica, datadaficha, valor, observacoes");
		$this->db->from("debitosclinica");
		return $this->db->get()->result();
	}

	public function pegar_por_id_comuns($id){
		$this->db->select("idlancamentos, datadaficha, nomepac, valor, forma, taxacartao, taxacomissao, quemlancou");
		$this->db->where("idlancamentos", $id, FALSE);
		$this->db->from("lancamentos");
		return $this->db->get()->first_row();
	}

	public function pegar_por_id_creditos($id){
		$this->db->select("idcreditos, datadaficha, observacoes, valor, quemlancou");
		$this->db->where("idcreditos", $id, FALSE);
		$this->db->from("creditos");
		return $this->db->get()->first_row();
	}

	public function pegar_por_id_debitos($id){
		$this->db->select("iddebitos, datadaficha, observacoes, valor, quemlancou");
		$this->db->where("iddebitos", $id, FALSE);
		$this->db->from("debitos");
		return $this->db->get()->first_row();
	}

	public function pegar_por_id_debitos_clinica($id){
		$this->db->select("iddebitosclinica, datadaficha, observacoes, valor, quemlancou");
		$this->db->where("iddebitosclinica", $id, FALSE);
		$this->db->from("debitosclinica");
		return $this->db->get()->first_row();
	}

	public function deletarcomuns($id){
		$this->db->where("idlancamentos", $id, FALSE);
		return $this->db->delete("lancamentos");
	}

	public function deletarcreditos($id){
		$this->db->where("idcreditos", $id, FALSE);
		return $this->db->delete("creditos");
	}

	public function deletardebitos($id){
		$this->db->where("iddebitos", $id, FALSE);
		return $this->db->delete("debitos");
	}

	public function deletardebitosclinica($id){
		$this->db->where("iddebitosclinica", $id, FALSE);
		return $this->db->delete("debitosclinica");
	}

	public function editarcomuns($id, $itens){
		$this->db->where("idlancamentos", $id, FALSE);
		$resultado = $this->db->update("lancamentos", $itens);
		if($resultado){
			return $id;
		} else {
			return FALSE;
		}
	}

	public function editarcreditos($id, $itens){
		$this->db->where("idcreditos", $id, FALSE);
		$resultado = $this->db->update("creditos", $itens);
		if($resultado){
			return $id;
		} else {
			return FALSE;
		}
	}

	public function editardebitos($id, $itens){
		$this->db->where("iddebitos", $id, FALSE);
		$resultado = $this->db->update("debitos", $itens);
		if($resultado){
			return $id;
		} else {
			return FALSE;
		}
	}

	public function editardebitosclinica($id, $itens){
		$this->db->where("iddebitosclinica", $id, FALSE);
		$resultado = $this->db->update("debitosclinica", $itens);
		if($resultado){
			return $id;
		} else {
			return FALSE;
		}
	}


	public function total_dinheiro(){
		$this->db->select_sum("valor");
		$this->db->from("lancamentos");
		$this->db->where("forma", "Dinheiro");
		$resultado = $this->db->get()->first_row();
		$resultado = $resultado->valor;
		return $resultado;
	}

	public function pegar_todos_cheques_array(){
		$this->db->select("valor");
		$this->db->where("forma", "Cheque");
		$this->db->from("lancamentos");
		$this->db->order_by("valor", "desc");
		$resultado = $this->db->get()->result_array();
		$resultado_puro = array();
		foreach($resultado as $key=>$r){
			foreach($r as $key2=>$r2){
				array_push($resultado_puro, $r2);
			}
		}
		return $resultado_puro;
	}
}