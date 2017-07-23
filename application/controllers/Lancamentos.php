<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lancamentos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Lancamentos_Model", "LancamentosM");
	}

	public function index()
	{
		$this->layout="dashboard";

		$data=array(
			"LANCAR-COMUM"                 => "lancamentos/salvar_comum",
			"BLOCO_SALDOS"                 => array(),
			"BLOCO_DADOSCOMUNS"            => array(),
			"BLOCO_SEMDADOSCOMUNS"         => array(),
			"BLOCO_CREDITOS"               => array(),
			"BLOCO_SEMCREDITOS"            => array(),
			"BLOCO_DEBITOS"                => array(),
			"BLOCO_SEMDEBITOS"             => array(),
			"BLOCO_DEBITOSCLINICA"         => array(),
			"BLOCO_SEMDEBITOSCLINICA"      => array(),
			"BLOCO_FECHARCAIXA"            => array(),
			"BLOCO_SEMFECHARCAIXA"         => array()
		);

		$respostasaldos         = $this->LancamentosM->pegarsaldos();
		$respostacomuns         = $this->LancamentosM->pegarcomuns();
		$respostacreditos       = $this->LancamentosM->pegarcreditos();
		$respostadebitos        = $this->LancamentosM->pegardebitos();
		$respostadebitosclinica = $this->LancamentosM->pegardebitosclinica();
		

		$saldodentista       = 0;
		$saldoclinica        = 0;
		$totaldinheirovivo   = 0;
		$totaldinheirocartao = 0;
		$totaldinheirocheque = 0;
		$totalparaodentistavl= 0;
		$totalparaodentista  = 0;
		$totalparaaclinica   = 0;
		$totalcreditos       = 0;
		$totaldebitos        = 0;


		if($respostasaldos){
			foreach($respostasaldos as $r){
				$saldodentista = $r->saldodentista;
				$saldoclinica  = $r->saldoclinica;
				$data["BLOCO_SALDOS"][] = array(
					"saldodentista" => "R$ ".str_replace(".", ",", $r->saldodentista),
					"saldoclinica"  => "R$ ".str_replace(".", ",", $r->saldoclinica)
				);
			}
		}

		if($respostacomuns){
			foreach($respostacomuns as $r){
				$valorliquido      = $this->valor_liquido($r->valor, $r->taxacartao, $r->taxacomissao);

				$valorparaaclinica = $r->valor - $valorliquido;

				$data["BLOCO_DADOSCOMUNS"][] = array(
					"URLEDITARCOMUNS"    => site_url("lancamentos/editarcomuns/".$r->idlancamentos),
					"URLDELETARCOMUNS"   => site_url("lancamentos/confirmar_deletarcomuns/".$r->idlancamentos),					
					"datadaficha"  => $this->corrigir_ano($r->datadaficha),
					"nomepac"      => $r->nomepac,
					"valor"        => "R$ ".number_format($r->valor, 2, ',', ''),
					"forma"        => $r->forma,
					"taxacartao"   => str_replace(".", ",", $r->taxacartao)." %",
					"taxacomissao" => str_replace(".", ",", $r->taxacomissao)." %",
					"valorliquido" => "R$ ".number_format($valorliquido, 2, ',', ''),
				);

				if($r->forma == "Dinheiro"){
					$totaldinheirovivo += $r->valor;	
				}
				if($r->forma == "C.Crédito" OR $r->forma == "C.Débito"){
					$totaldinheirocartao += $r->valor;	
				}
				if($r->forma == "Cheque"){
					$totaldinheirocheque += $r->valor;	
				}
				
				$totalparaodentistavl += $valorliquido;

			}
			
		} else {
			$data["BLOCO_SEMDADOSCOMUNS"][] = array();
		}

		if($respostacreditos){
			foreach($respostacreditos as $r){

				$data["BLOCO_CREDITOS"][] = array(
					"URLEDITARCREDITO"    => site_url("lancamentos/editarcreditos/".$r->idcreditos),
					"URLDELETARCREDITO"   => site_url("lancamentos/confirmar_deletarcreditos/".$r->idcreditos),					
					"datadafichacredito"  => $this->corrigir_ano($r->datadaficha),
					"observacoescredito"  => $r->observacoes,
					"valorcredito"        => "R$ ".str_replace(".", ",", $r->valor),
				);

				$totalcreditos += $r->valor;
			}
			
		} else {
			$data["BLOCO_SEMCREDITOS"][] = array();
		}

		if($respostadebitos){
			foreach($respostadebitos as $r){

				$data["BLOCO_DEBITOS"][] = array(
					"URLEDITARDEBITO"    => site_url("lancamentos/editardebitos/".$r->iddebitos),
					"URLDELETARDEBITO"   => site_url("lancamentos/confirmar_deletardebitos/".$r->iddebitos),					
					"datadafichadebito"  => $this->corrigir_ano($r->datadaficha),
					"observacoesdebito"  => $r->observacoes,
					"valordebito"        => "R$ ".str_replace(".", ",", $r->valor),
				);

				$totaldebitos += $r->valor;
			}
			
		} else {
			$data["BLOCO_SEMDEBITOS"][] = array();
		}

		if($respostadebitosclinica){
			foreach($respostadebitosclinica as $r){

				$data["BLOCO_DEBITOSCLINICA"][] = array(
					"URLEDITARDEBITO"    => site_url("lancamentos/editardebitosclinica/".$r->iddebitosclinica),
					"URLDELETARDEBITO"   => site_url("lancamentos/confirmar_deletardebitosclinica/".$r->iddebitosclinica),					
					"datadafichadebito"  => $this->corrigir_ano($r->datadaficha),
					"observacoesdebito"  => $r->observacoes,
					"valordebito"        => "R$ ".str_replace(".", ",", $r->valor),
				);

				$totaldebitos += $r->valor;
			}
			
		} else {
			$data["BLOCO_SEMDEBITOSCLINICA"][] = array();
		}

		$totalrealnocaixa      = $totaldinheirovivo+$totaldinheirocheque+$totaldebitos;
		$totalparaodentista    = ($totalparaodentistavl+$totaldebitos+$totalcreditos)+$saldodentista;
		$totaldinheiro         = $totaldinheirovivo+$totaldebitos;
		$totalclinica          = ($totalrealnocaixa-$totalparaodentista)+$saldoclinica;
		$data["TOTALDINHEIRO"] = "R$ ".number_format($totaldinheiro, 2, ',', '');
		$data["TOTALCARTAO"]   = "R$ ".number_format($totaldinheirocartao, 2, ',', '');
		$data["TOTALCHEQUE"]   = "R$ ".number_format($totaldinheirocheque, 2, ',', '');
		$data["TOTALREAL"]     = "R$ ".number_format($totalrealnocaixa, 2, ',', '');
		$data["TOTALDENTISTA"] = "R$ ".number_format($totalparaodentista, 2, ',', '');
		$data["TOTALCLINICA"]  = "R$ ".number_format($totalclinica, 2, ',', '');

		$autorizacao_fechar_caixa = $this->milagre($totaldinheiro, $totalparaodentista);
		

		if($autorizacao_fechar_caixa["liberacao"]){
			$data["BLOCO_FECHARCAIXA"][] = array(
				"TOTALDENTISTA" => number_format($totalparaodentista, 2, ',', '.'),
				"TOTALCLINICA"  => number_format($totalrealnocaixa-$totalparaodentista+$totaldebitos, 2, ',', '.')
			);
		} else {
			$data["BLOCO_SEMFECHARCAIXA"][] = array(
				"VALORDARLIQUIDEZ" => number_format($autorizacao_fechar_caixa["quanto_faltou"], 2, ',', '')
			);
		}
		
		$this->parser->parse('lancamentos', $data);
	}

	public function salvar_comum()
	{
		//CAPTURA DOS DADOS VIA MÉTODO POST
		$datadolancamento  = date("Y-m-d");
		$datacru           = $this->input->post("datadaficha");
		$ano               = substr($datacru, -4, 4);
		$mes               = substr($datacru, -7, 2);
		$dia               = substr($datacru, -10, 2);
		$datadaficha       = $ano."-".$mes."-".$dia;
		$nomepac           = $this->input->post("nomepac");
		$valor             = number_format($this->moedabrl_para_moedausd($this->input->post("valor")), 2, '.', '');
		$forma             = $this->input->post("forma");
		$tipolancamento    = $this->input->post("tipolancamento");

		if($this->input->post("taxacartao")){
			$taxacartao    = str_replace(",", ".", $this->input->post("taxacartao"));
		} else {
			$taxacartao    = 0;
		}

		$taxacomissao      = $this->input->post("taxacomissao");
		$quemlancou        = $this->input->post("quemlancou");

		
		//VERIFICAÇÃO SE OS DADOS VIERAM
		$erros    = FALSE;
		$mensagem = null;
		
		if(!$datacru){
			$erros = TRUE;
			$mensagem .= "Informe a data\n";
		}
		if(!$nomepac){
			$erros = TRUE;
			$mensagem .= "Informe o nome do paciente\n";
		}
		if(!$valor){
			$erros = TRUE;
			$mensagem .= "Informe o valor\n";
		}
		if(!$forma){
			$erros = TRUE;
			$mensagem .= "Informe a forma de pagamento\n";
		}

		if(!$taxacomissao){
			$erros = TRUE;
			$mensagem .= "Informe a taxa de comissão\n";
		}
		if(!$quemlancou){
			$erros = TRUE;
			$mensagem .= "Informe quem fez este lançamento\n";
		}


		if(!$erros){
			$itens = array ( //COLOCAMOS OS DADOS PROVENIENTES DO FORM DENTRO DA ARRAY QUE SERÁ ENVIADA AO MODEL
				"datadolancamento" => $datadolancamento,
				"datadaficha"      => $datadaficha,
				"nomepac"          => $nomepac,
				"valor"            => $valor,
				"forma"            => $forma,
				"taxacartao"       => $taxacartao,
				"taxacomissao"     => $taxacomissao,
				"quemlancou"       => $quemlancou,
				"tipolancamento"   => $tipolancamento
			);
			$resul = $this->LancamentosM->postarcomuns($itens);

			$this->session->set_flashdata("sucesso", "Dados inseridos com sucesso!");
			redirect("lancamentos");
		} else {
			$this->session->set_flashdata("erro", nl2br($mensagem));
			redirect("lancamentos");
		}
		//FIM DA VERIFICAÇÃO E ENVIO SE TUDO OK
	}

	public function salvar_creditos()
	{
		//CAPTURA DOS DADOS VIA MÉTODO POST
		$datadolancamento  = date("Y-m-d");
		$datacru           = $this->input->post("datacredito");
		$ano               = substr($datacru, -4, 4);
		$mes               = substr($datacru, -7, 2);
		$dia               = substr($datacru, -10, 2);
		$datadaficha       = $ano."-".$mes."-".$dia;
		$observacoes       = $this->input->post("observacoescredito");
		$valor             = number_format(intval($this->moedabrl_para_moedausd($this->input->post("valorcredito"))), 2, '.', '');
		$tipolancamento    = $this->input->post("tipolancamento");
		$quemlancou        = $this->input->post("quemlancoucredito");

		
		//VERIFICAÇÃO SE OS DADOS VIERAM
		$erros    = FALSE;
		$mensagem = null;
		
		if(!$datacru){
			$erros = TRUE;
			$mensagem .= "Informe a data\n";
		}
		if(!$observacoes){
			$erros = TRUE;
			$mensagem .= "Informe as osbservações\n";
		}
		if(!$valor){
			$erros = TRUE;
			$mensagem .= "Informe o valor\n";
		}
		if(!$quemlancou){
			$erros = TRUE;
			$mensagem .= "Informe quem fez este lançamento\n";
		}


		if(!$erros){
			$itens = array ( //COLOCAMOS OS DADOS PROVENIENTES DO FORM DENTRO DA ARRAY QUE SERÁ ENVIADA AO MODEL
				"datadolancamento" => $datadolancamento,
				"datadaficha"      => $datadaficha,
				"observacoes"      => $observacoes,
				"valor"            => $valor,
				"quemlancou"       => $quemlancou,
				"tipo"             => $tipolancamento
			);
			$resul = $this->LancamentosM->postarcreditos($itens);

			$this->session->set_flashdata("sucesso", "Dados inseridos com sucesso!");
			redirect("lancamentos");
		} else {
			$this->session->set_flashdata("erro", nl2br($mensagem));
			redirect("lancamentos");
		}
		//FIM DA VERIFICAÇÃO E ENVIO SE TUDO OK
	}

	public function salvar_debitos()
	{
		//CAPTURA DOS DADOS VIA MÉTODO POST
		$datadolancamento  = date("Y-m-d");
		$datacru           = $this->input->post("datadebito");
		$ano               = substr($datacru, -4, 4);
		$mes               = substr($datacru, -7, 2);
		$dia               = substr($datacru, -10, 2);
		$datadaficha       = $ano."-".$mes."-".$dia;
		$observacoes       = $this->input->post("observacoesdebito");
		$valor             = number_format($this->moedabrl_para_moedausd($this->input->post("valordebito")), 2, '.', '');
		$tipolancamento    = $this->input->post("tipolancamento");
		$quemlancou        = $this->input->post("quemlancoudebito");

		
		//VERIFICAÇÃO SE OS DADOS VIERAM
		$erros    = FALSE;
		$mensagem = null;
		
		if(!$datacru){
			$erros = TRUE;
			$mensagem .= "Informe a data\n";
		}
		if(!$observacoes){
			$erros = TRUE;
			$mensagem .= "Informe as osbservações\n";
		}
		if(!$valor){
			$erros = TRUE;
			$mensagem .= "Informe o valor\n";
		}
		if(!$quemlancou){
			$erros = TRUE;
			$mensagem .= "Informe quem fez este lançamento\n";
		}


		if(!$erros){
			$itens = array ( //COLOCAMOS OS DADOS PROVENIENTES DO FORM DENTRO DA ARRAY QUE SERÁ ENVIADA AO MODEL
				"datadolancamento" => $datadolancamento,
				"datadaficha"      => $datadaficha,
				"observacoes"      => $observacoes,
				"valor"            => $valor,
				"quemlancou"       => $quemlancou,
				"tipo"             => $tipolancamento
			);
			$resul = $this->LancamentosM->postardebitos($itens);

			$this->session->set_flashdata("sucesso", "Dados inseridos com sucesso!");
			redirect("lancamentos");
		} else {
			$this->session->set_flashdata("erro", nl2br($mensagem));
			redirect("lancamentos");
		}
		//FIM DA VERIFICAÇÃO E ENVIO SE TUDO OK
	}

	public function salvar_debitos_clinica()
	{
		//CAPTURA DOS DADOS VIA MÉTODO POST
		$datadolancamento  = date("Y-m-d");
		$datacru           = $this->input->post("datadebito");
		$ano               = substr($datacru, -4, 4);
		$mes               = substr($datacru, -7, 2);
		$dia               = substr($datacru, -10, 2);
		$datadaficha       = $ano."-".$mes."-".$dia;
		$observacoes       = $this->input->post("observacoesdebito");
		$valor             = number_format($this->moedabrl_para_moedausd($this->input->post("valordebito")), 2, '.', '');
		$tipolancamento    = $this->input->post("tipolancamento");
		$quemlancou        = $this->input->post("quemlancoudebito");

		
		//VERIFICAÇÃO SE OS DADOS VIERAM
		$erros    = FALSE;
		$mensagem = null;
		
		if(!$datacru){
			$erros = TRUE;
			$mensagem .= "Informe a data\n";
		}
		if(!$observacoes){
			$erros = TRUE;
			$mensagem .= "Informe as osbservações\n";
		}
		if(!$valor){
			$erros = TRUE;
			$mensagem .= "Informe o valor\n";
		}
		if(!$quemlancou){
			$erros = TRUE;
			$mensagem .= "Informe quem fez este lançamento\n";
		}


		if(!$erros){
			$itens = array ( //COLOCAMOS OS DADOS PROVENIENTES DO FORM DENTRO DA ARRAY QUE SERÁ ENVIADA AO MODEL
				"datadolancamento" => $datadolancamento,
				"datadaficha"      => $datadaficha,
				"observacoes"      => $observacoes,
				"valor"            => $valor,
				"quemlancou"       => $quemlancou,
				"tipo"             => $tipolancamento
			);
			$resul = $this->LancamentosM->postardebitosclinica($itens);

			$this->session->set_flashdata("sucesso", "Dados inseridos com sucesso!");
			redirect("lancamentos");
		} else {
			$this->session->set_flashdata("erro", nl2br($mensagem));
			redirect("lancamentos");
		}
		//FIM DA VERIFICAÇÃO E ENVIO SE TUDO OK
	}

	public function dar_liquidez()
	{
		//CAPTURA DOS DADOS VIA MÉTODO POST
		$datadolancamento  = date("Y-m-d");
		$datadaficha       = date("Y-m-d");
		$nomepac           = "APORTE PARA LIQUIDEZ";
		$valor             = number_format($this->moedabrl_para_moedausd($this->input->post("valoraporte")), 2, '.', '');
		$forma             = "Dinheiro";
		$tipolancamento    = "aporte";
		$taxacartao        = 0;
		$taxacomissao      = 0;
		$quemlancou        = "Aporte";

		
		//VERIFICAÇÃO SE OS DADOS VIERAM
		$erros    = FALSE;
		$mensagem = null;
		
		
		if(!$valor){
			$erros = TRUE;
			$mensagem .= "Informe o valor do Aporte\n";
		}

		if(!$erros){
			$itens = array ( //COLOCAMOS OS DADOS PROVENIENTES DO FORM DENTRO DA ARRAY QUE SERÁ ENVIADA AO MODEL
				"datadolancamento" => $datadolancamento,
				"datadaficha"      => $datadaficha,
				"nomepac"          => $nomepac,
				"valor"            => $valor,
				"forma"            => $forma,
				"taxacartao"       => $taxacartao,
				"taxacomissao"     => $taxacomissao,
				"quemlancou"       => $quemlancou,
				"tipolancamento"   => $tipolancamento
			);
			$resul = $this->LancamentosM->postarcomuns($itens);

			$this->session->set_flashdata("sucesso", "Aporte inserido com sucesso!");
			redirect("lancamentos");
		} else {
			$this->session->set_flashdata("erro", nl2br($mensagem));
			redirect("lancamentos");
		}
		//FIM DA VERIFICAÇÃO E ENVIO SE TUDO OK
	}

	public function confirmar_deletarcomuns($id_deletar)
	{
		$this->layout="dashboard";

		$data=array(
			"BLOCO_DADOS"       => array(),
			"BLOCO_SEMDADOS"    => array(),
		
		);



		$resposta= $this->LancamentosM->pegar_por_id_comuns($id_deletar);

		if($resposta){
				$data["BLOCO_DADOS"][] = array(
					"datadaficha"  => $this->corrigir_ano($resposta->datadaficha),
					"nomepac"      => $resposta->nomepac,
					"valor"        => "R$ ".str_replace(".", ",", $resposta->valor),
					"forma"        => $resposta->forma,
					"taxacartao"   => str_replace(".", ",", $resposta->taxacartao)." %",
					"taxacomissao" => str_replace(".", ",", $resposta->taxacomissao)." %",
					"valorliquido" => "R$ ".str_replace(".", ",", $this->valor_liquido($resposta->valor, $resposta->taxacartao, $resposta->taxacomissao)),
					"URLDELETAR"        => site_url("lancamentos/deletarcomuns/".$id_deletar)
				);
		} else {
			$data["BLOCO_SEMDADOS"][] = array();
		}


		$this->parser->parse('confirmar_deletarcomuns', $data);
	}

	public function confirmar_deletarcreditos($id_deletar)
	{
		$this->layout="dashboard";

		$data=array(
			"BLOCO_DADOS"       => array(),
			"BLOCO_SEMDADOS"    => array(),
		);

		$resposta= $this->LancamentosM->pegar_por_id_creditos($id_deletar);

		if($resposta){
				$data["BLOCO_DADOS"][] = array(
					"datadaficha"  => $this->corrigir_ano($resposta->datadaficha),
					"observacoes"  => $resposta->observacoes,
					"valor"        => "R$ ".str_replace(".", ",", $resposta->valor),
					"URLDELETAR"        => site_url("lancamentos/deletarcreditos/".$id_deletar)
				);
		} else {
			$data["BLOCO_SEMDADOS"][] = array();
		}


		$this->parser->parse('confirmar_deletarcreditos', $data);
	}

	public function confirmar_deletardebitos($id_deletar)
	{
		$this->layout="dashboard";

		$data=array(
			"BLOCO_DADOS"       => array(),
			"BLOCO_SEMDADOS"    => array(),
		);

		$resposta= $this->LancamentosM->pegar_por_id_debitos($id_deletar);

		if($resposta){
				$data["BLOCO_DADOS"][] = array(
					"datadaficha"  => $this->corrigir_ano($resposta->datadaficha),
					"observacoes"  => $resposta->observacoes,
					"valor"        => "R$ ".str_replace(".", ",", $resposta->valor),
					"URLDELETAR"        => site_url("lancamentos/deletardebitos/".$id_deletar)
				);
		} else {
			$data["BLOCO_SEMDADOS"][] = array();
		}


		$this->parser->parse('confirmar_deletardebitos', $data);
	}

	public function confirmar_deletardebitosclinica($id_deletar)
	{
		$this->layout="dashboard";

		$data=array(
			"BLOCO_DADOS"       => array(),
			"BLOCO_SEMDADOS"    => array(),
		);

		$resposta= $this->LancamentosM->pegar_por_id_debitos_clinica($id_deletar);

		if($resposta){
				$data["BLOCO_DADOS"][] = array(
					"datadaficha"  => $this->corrigir_ano($resposta->datadaficha),
					"observacoes"  => $resposta->observacoes,
					"valor"        => "R$ ".str_replace(".", ",", $resposta->valor),
					"URLDELETAR"        => site_url("lancamentos/deletardebitosclinica/".$id_deletar)
				);
		} else {
			$data["BLOCO_SEMDADOS"][] = array();
		}


		$this->parser->parse('confirmar_deletardebitosclinica', $data);
	}

	public function confirmar_acerto()
	{
		$this->layout="dashboard";

		$datadolancamento  = date("Y-m-d");
		$datacru           = $this->input->post("datadoacerto");
		$ano               = substr($datacru, -4, 4);
		$mes               = substr($datacru, -7, 2);
		$dia               = substr($datacru, -10, 2);
		$datadoacerto      = $ano."-".$mes."-".$dia;
		$quemlancou        = $this->input->post("quemfezacerto");

		$repassadodentistadinheiro = $this->input->post("valorrepassadodinheiro") == "" ? 0 : number_format($this->moedabrl_para_moedausd($this->input->post("valorrepassadodinheiro")), 2, '.', '');
		$repassadodentistacheque   = $this->input->post("valorrepassadocheque") == "" ? 0 : number_format($this->moedabrl_para_moedausd($this->input->post("valorrepassadocheque")), 2, '.', '');
		$repassadoclinicadinheiro  = $this->input->post("valorclinicadinheiro") == "" ? 0 : number_format($this->moedabrl_para_moedausd($this->input->post("valorclinicadinheiro")), 2, '.', '');
		$repassadoclinicacheque    = $this->input->post("valorclinicacheque") == "" ? 0 : number_format($this->moedabrl_para_moedausd($this->input->post("valorclinicacheque")), 2, '.', '');


		$data=array(
			"BLOCO_DADOSCOMUNS"      => array(),
			"BLOCO_SEMDADOSCOMUNS"   => array(),
			"BLOCO_CREDITOS"         => array(),
			"BLOCO_SEMCREDITOS"      => array(),
			"BLOCO_DEBITOS"          => array(),
			"BLOCO_SEMDEBITOS"       => array(),
			"BLOCO_DEBITOSCLINICA"   => array(),
			"BLOCO_SEMDEBITOSCLINICA"=> array()
		);

		$respostasaldos         = $this->LancamentosM->pegarsaldos();
		$respostacomuns         = $this->LancamentosM->pegarcomuns();
		$respostacreditos       = $this->LancamentosM->pegarcreditos();
		$respostadebitos        = $this->LancamentosM->pegardebitos();
		$respostadebitosclinica = $this->LancamentosM->pegardebitosclinica();
		

		$saldodentistaprevio       = 0;
		$saldoclinicaprevio        = 0;
		$totaldinheirovivo         = 0;
		$totaldinheirocartao       = 0;
		$totaldinheirocheque       = 0;
		$totalparaodentistavl      = 0;
		$totalparaodentista        = 0;
		$totalparaaclinica         = 0;
		$totalcreditos             = 0;
		$totaldebitos              = 0;
		$totaldebitosclinica       = 0;
		$totalfaturamento          = 0;
		$saldodentista             = 0;
		$saldoclinica              = 0;


		if($respostasaldos){
			foreach($respostasaldos as $r){
				$saldodentistaprevio = $r->saldodentista;
				$saldoclinicaprevio  = $r->saldoclinica;
				$data["saldodentistaprevio"] = "R$ ".str_replace(".", ",", $r->saldodentista);
				$data["saldoclinicaprevio"]  = "R$ ".str_replace(".", ",", $r->saldoclinica);
			}
		}

		if($respostacomuns){
			foreach($respostacomuns as $r){
				$valorliquido      = $this->valor_liquido($r->valor, $r->taxacartao, $r->taxacomissao);

				$valorparaaclinica = $r->valor - $valorliquido;

				$data["BLOCO_DADOSCOMUNS"][] = array(
					"URLEDITARCOMUNS"    => site_url("lancamentos/editarcomuns/".$r->idlancamentos),
					"URLDELETARCOMUNS"   => site_url("lancamentos/confirmar_deletarcomuns/".$r->idlancamentos),					
					"datadaficha"  => $this->corrigir_ano($r->datadaficha),
					"nomepac"      => $r->nomepac,
					"valor"        => "R$ ".number_format($r->valor, 2, ',', ''),
					"forma"        => $r->forma,
					"taxacartao"   => str_replace(".", ",", $r->taxacartao)." %",
					"taxacomissao" => str_replace(".", ",", $r->taxacomissao)." %",
					"valorliquido" => "R$ ".number_format($valorliquido, 2, ',', ''),
				);

				if($r->forma == "Dinheiro"){
					$totaldinheirovivo += $r->valor;	
				}
				if($r->forma == "C.Crédito" OR $r->forma == "C.Débito"){
					$totaldinheirocartao += $r->valor;	
				}
				if($r->forma == "Cheque"){
					$totaldinheirocheque += $r->valor;	
				}
				
				$totalparaodentistavl += $valorliquido;

			}
			
		} else {
			$data["BLOCO_SEMDADOSCOMUNS"][] = array();
		}

		if($respostacreditos){
			foreach($respostacreditos as $r){

				$data["BLOCO_CREDITOS"][] = array(
					"URLEDITARCREDITO"    => site_url("lancamentos/editarcreditos/".$r->idcreditos),
					"URLDELETARCREDITO"   => site_url("lancamentos/confirmar_deletarcreditos/".$r->idcreditos),					
					"datadafichacredito"  => $this->corrigir_ano($r->datadaficha),
					"observacoescredito"  => $r->observacoes,
					"valorcredito"        => "R$ ".str_replace(".", ",", $r->valor),
				);

				$totalcreditos += $r->valor;
			}
			
		} else {
			$data["BLOCO_SEMCREDITOS"][] = array();
		}

		if($respostadebitos){
			foreach($respostadebitos as $r){

				$data["BLOCO_DEBITOS"][] = array(					
					"datadafichadebito"  => $this->corrigir_ano($r->datadaficha),
					"observacoesdebito"  => $r->observacoes,
					"valordebito"        => "R$ ".str_replace(".", ",", $r->valor),
				);

				$totaldebitos += $r->valor;
			}
			
		} else {
			$data["BLOCO_SEMDEBITOS"][] = array();
		}

		if($respostadebitosclinica){
			foreach($respostadebitosclinica as $r){

				$data["BLOCO_DEBITOSCLINICA"][] = array(					
					"datadafichadebitoclinica"  => $this->corrigir_ano($r->datadaficha),
					"observacoesdebitoclinica"  => $r->observacoes,
					"valordebitoclinica"        => "R$ ".str_replace(".", ",", $r->valor),
				);

				$totaldebitosclinica += $r->valor;
			}
			
		} else {
			$data["BLOCO_SEMDEBITOSCLINICA"][] = array();
		}

		$totalrealnocaixa      = $totaldinheirovivo+$totaldinheirocheque+$totaldebitos;
		$totalparaodentista    = ($totalparaodentistavl+$totaldebitos+$totalcreditos);
		$totalparaaclinica     = ($totalrealnocaixa-$totalparaodentista);
		$totaldinheiro         = $totaldinheirovivo+$totaldebitos;
		$totalrepassadodentista= $repassadodentistadinheiro+$repassadodentistacheque;
		$totalrepassadoclinica = $repassadoclinicadinheiro+$repassadoclinicacheque;
		$novosaldodentista     = ($totalparaodentista+$saldodentista)-$totalparaodentista;
		$novosaldoclinica      = ($totalparaaclinica+$saldoclinica)-$totalparaaclinica;
		$totalfaturamento      = $totaldinheirovivo+$totaldinheirocheque+$totaldinheirocartao;
		
		//VERIFICAÇÃO SE OS DADOS VIERAM
		$erros    = FALSE;
		$mensagem = null;
		
		if(!$datacru){
			$erros = TRUE;
			$mensagem .= "Digite uma data para o acerto. \n";
		}

		if(!$quemlancou){
			$erros = TRUE;
			$mensagem .= "Diga quem fez o acerto por parte da Clínica. \n";
		}

		if($repassadodentistadinheiro == 0 && $repassadodentistacheque == 0 && $repassadoclinicadinheiro == 0 && $repassadoclinicacheque == 0){
			$erros = TRUE;
			$mensagem .= "Ta de brincadeira? Para fazer o fechamento do caixa, alguém precisa receber alguma coisa. \n";
		}

		if($repassadodentistadinheiro > $totaldinheirovivo){
			$erros = TRUE;
			$mensagem .= "O valor informado no campo de Dinheiro para o Dentista é maior do que o atualmente em dinheiro no caixa.\n";
		}

		if($repassadodentistacheque > $totaldinheirocheque){
			$erros = TRUE;
			$mensagem .= "O valor informado no campo de Cheque para o Dentista é maior do que o atualmente em cheque no caixa.\n";
		}

		if($repassadoclinicadinheiro > $totaldinheirovivo){
			$erros = TRUE;
			$mensagem .= "O valor informado no campo de Dinheiro para a Clínica é maior do que o atualmente em dinheiro no caixa.\n";
		}

		if($repassadoclinicacheque > $totaldinheirocheque){
			$erros = TRUE;
			$mensagem .= "O valor informado no campo de Cheque para a Clínica é maior do que o atualmente em cheque no caixa.\n";
		}

		if($repassadodentistadinheiro+$repassadodentistacheque > $totalrealnocaixa){
			$erros = TRUE;
			$mensagem .= "O valor em Dinheiro + Cheque para o Dentista é maior que o valor total em caixa.\n";
		}

		if($repassadoclinicadinheiro+$repassadoclinicacheque > $totalrealnocaixa){
			$erros = TRUE;
			$mensagem .= "O valor em Dinheiro + Cheque para a Clínica é maior que o valor total em caixa.\n";
		}

		if($repassadodentistadinheiro+$repassadoclinicadinheiro > $totaldinheirovivo){
			$erros = TRUE;
			$mensagem .= "Não há dinheiro suficiente para o Dentista e a Clínica ao mesmo tempo.";
		}

		if($repassadodentistacheque+$repassadoclinicacheque > $totaldinheirocheque){
			$erros = TRUE;
			$mensagem .= "Não há cheques suficiente para o Dentista e a Clínica ao mesmo tempo.";
		}

		if($erros){
			$this->session->set_flashdata("erro", nl2br($mensagem));
			redirect("lancamentos");
		}

		$data["TOTALDINHEIRO"] = "R$ ".number_format($totaldinheiro, 2, ',', '');
		$data["TOTALCARTAO"]   = "R$ ".number_format($totaldinheirocartao, 2, ',', '');
		$data["TOTALCHEQUE"]   = "R$ ".number_format($totaldinheirocheque, 2, ',', '');
		$data["TOTALREAL"]     = "R$ ".number_format($totalrealnocaixa, 2, ',', '');
		$data["TOTALDENTISTA"] = "R$ ".number_format($totalparaodentista, 2, ',', '');
		$data["TOTALCLINICA"]  = "R$ ".number_format($totalparaaclinica, 2, ',', '');
		$data["datadoacerto"]  = $datacru;
		$data["quemafezacerto"]= $quemlancou;
		$data["totaldinheiro"] = "R$ ".number_format($totaldinheiro, 2, ',', '');
		$data["totalcartao"]   = "R$ ".number_format($totaldinheirocartao, 2, ',', '');
		$data["totalcheque"]   = "R$ ".number_format($totaldinheirocheque, 2, ',', '');
		$data["totalfaturamento"] = "R$ ".number_format($totalfaturamento, 2, ',', '');
		$data["totalcomissao"] = "R$ ".number_format($totalparaodentista, 2, ',', '');
		$data["totalpclinica"] = "R$ ".number_format($totalparaaclinica, 2, ',', '');
		$data["dentistadinheiro"] = "R$ ".number_format($repassadodentistadinheiro, 2, ',', '');
		$data["dentistacheque"] = "R$ ".number_format($repassadodentistacheque, 2, ',', '');
		$data["clinicadinheiro"] = "R$ ".number_format($repassadoclinicadinheiro, 2, ',', '');
		$data["clinicacheque"] = "R$ ".number_format($repassadoclinicacheque, 2, ',', '');
		$data["saldodentista"] = "R$ ".number_format($novosaldodentista, 2, ',', '');
		$data["saldoclinica"] = "R$ ".number_format($novosaldoclinica, 2, ',', '');
		$data["URLFINALIZAR"] = site_url("lancamentos/atualizar_saldos_finalizar/");

		$this->session->set_flashdata("novosaldodentista", $novosaldodentista);
		$this->session->set_flashdata("novosaldoclinica", $novosaldoclinica);


		$this->parser->parse('confirmar_acerto', $data);
	}

	public function atualizar_saldos_finalizar(){

		$novosaldodentista = $this->session->flashdata("novosaldodentista");
		$novosaldoclinica  = $this->session->set_flashdata("novosaldoclinica");
		$resultado = $this->LancamentosM->atualizar_saldos($novosaldodentista, $novosaldoclinica);

		if ($resultado){
			$this->session->set_flashdata("sucesso", "Novos Saldos salvos com sucesso e Caixa Reiniciado.");
			$this->LancamentosM->limpar_todas_tabelas();
			redirect("lancamentos");
		} else {
			$this->session->set_flashdata("erro", "Houve algum erro na Finalização do Caixa. Verifique com o administrador.");
			redirect("lancamentos");
		}


	}

	public function deletarcomuns($id)
	{
		if($id){
			$this->LancamentosM->deletarcomuns($id);
			$this->session->set_flashdata("sucesso", "Lançamento deletado com sucesso!");
			redirect("lancamentos");	
		} else {
			$this->session->set_flashdata("erro", "Selecione um Lançamento a ser deletado.");
			redirect("lancamentos");
		}	
	}

	public function deletarcreditos($id)
	{
		if($id){
			$this->LancamentosM->deletarcreditos($id);
			$this->session->set_flashdata("sucesso", "Crédito deletado com sucesso!");
			redirect("lancamentos");	
		} else {
			$this->session->set_flashdata("erro", "Selecione um Crédito a ser deletado.");
			redirect("lancamentos");
		}	
	}

	public function deletardebitos($id)
	{
		if($id){
			$this->LancamentosM->deletardebitos($id);
			$this->session->set_flashdata("sucesso", "Saída deletada com sucesso!");
			redirect("lancamentos");	
		} else {
			$this->session->set_flashdata("erro", "Selecione uma Saída a ser deletada.");
			redirect("lancamentos");
		}	
	}

	public function deletardebitosclinica($id)
	{
		if($id){
			$this->LancamentosM->deletardebitosclinica($id);
			$this->session->set_flashdata("sucesso", "Saída deletada com sucesso!");
			redirect("lancamentos");	
		} else {
			$this->session->set_flashdata("erro", "Selecione uma Saída a ser deletada.");
			redirect("lancamentos");
		}	
	}

	public function editarcomuns($id_editar)
	{
		$this->layout="dashboard";

		$data=array(
			"BLOCO_DADOS"       => array(),
			"BLOCO_SEMDADOS"    => array(),
		
		);



		$resposta= $this->LancamentosM->pegar_por_id_comuns($id_editar);

		
		if($resposta){
			$data["BLOCO_DADOS"][] = array(
				"idlancamentos"  => $resposta->idlancamentos,
				"datadaficha"    => $this->corrigir_ano($resposta->datadaficha),
				"nomepac"        => $resposta->nomepac,
				"valor"          => number_format($resposta->valor, 2, ',', '.'),
				"selectdinheiro" => ($resposta->forma == "Dinheiro" ? "selected" : null),
				"selectcheque"   => ($resposta->forma == "Cheque" ? "selected" : null),
				"selectccredito" => ($resposta->forma == "C.Crédito" ? "selected" : null),
				"selectcdebito"  => ($resposta->forma == "C.Débito" ? "selected" : null),
				"taxacartao"     => str_replace(".", ",", $resposta->taxacartao),
				"taxacomissao"   => str_replace(".", ",", $resposta->taxacomissao),
				"quemlancou"     => $resposta->quemlancou
			);
		} else {
			$data["BLOCO_SEMDADOS"][] = array();
		}


		$this->parser->parse('editarcomuns', $data);
	}

	public function editarcreditos($id_editar)
	{
		$this->layout="dashboard";

		$data=array(
			"BLOCO_DADOS"       => array(),
			"BLOCO_SEMDADOS"    => array(),
		
		);



		$resposta= $this->LancamentosM->pegar_por_id_creditos($id_editar);

		
		if($resposta){
			$data["BLOCO_DADOS"][] = array(
				"idcreditos"  => $resposta->idcreditos,
				"datadaficha" => $this->corrigir_ano($resposta->datadaficha),
				"observacoes" => $resposta->observacoes,
				"valor"       => number_format($resposta->valor, 2, ',', '.'),
				"quemlancou"  => $resposta->quemlancou
			);
		} else {
			$data["BLOCO_SEMDADOS"][] = array();
		}


		$this->parser->parse('editarcreditos', $data);
	}

	public function editardebitos($id_editar)
	{
		$this->layout="dashboard";

		$data=array(
			"BLOCO_DADOS"       => array(),
			"BLOCO_SEMDADOS"    => array(),
		
		);



		$resposta= $this->LancamentosM->pegar_por_id_debitos($id_editar);

		
		if($resposta){
			$data["BLOCO_DADOS"][] = array(
				"iddebitos"  => $resposta->iddebitos,
				"datadaficha" => $this->corrigir_ano($resposta->datadaficha),
				"observacoes" => $resposta->observacoes,
				"valor"       => number_format($resposta->valor, 2, ',', '.'),
				"quemlancou"  => $resposta->quemlancou
			);
		} else {
			$data["BLOCO_SEMDADOS"][] = array();
		}

		$this->parser->parse('editardebitos', $data);
	}

	public function editardebitosclinica($id_editar)
	{
		$this->layout="dashboard";

		$data=array(
			"BLOCO_DADOS"       => array(),
			"BLOCO_SEMDADOS"    => array(),
		
		);



		$resposta= $this->LancamentosM->pegar_por_id_debitos_clinica($id_editar);

		
		if($resposta){
			$data["BLOCO_DADOS"][] = array(
				"iddebitosclinica"  => $resposta->iddebitosclinica,
				"datadaficha" => $this->corrigir_ano($resposta->datadaficha),
				"observacoes" => $resposta->observacoes,
				"valor"       => number_format($resposta->valor, 2, ',', '.'),
				"quemlancou"  => $resposta->quemlancou
			);
		} else {
			$data["BLOCO_SEMDADOS"][] = array();
		}

		$this->parser->parse('editardebitosclinica', $data);
	}

	public function salvar_editar_comuns()
	{
		//CAPTURA DOS DADOS VIA MÉTODO POST
		$idlancamentos     = $this->input->post("idlancamentos");
		$datadolancamento  = date("Y-m-d");
		$datacru           = $this->input->post("datadaficha");
		$ano               = substr($datacru, -4, 4);
		$mes               = substr($datacru, -7, 2);
		$dia               = substr($datacru, -10, 2);
		$datadaficha       = $ano."-".$mes."-".$dia;
		$nomepac           = $this->input->post("nomepac");
		$valor             = number_format($this->moedabrl_para_moedausd($this->input->post("valor")), 2, '.', '');
		$forma             = $this->input->post("forma");

		if($this->input->post("taxacartao")){
			$taxacartao    = str_replace(",", ".", $this->input->post("taxacartao"));
		} else {
			$taxacartao    = 0;
		}

		$taxacomissao      = $this->input->post("taxacomissao");
		$quemlancou        = $this->input->post("quemlancou");

		
		//VERIFICAÇÃO SE OS DADOS VIERAM
		$erros    = FALSE;
		$mensagem = null;
		
		if(!$datacru){
			$erros = TRUE;
			$mensagem .= "Informe a data\n";
		}
		if(!$nomepac){
			$erros = TRUE;
			$mensagem .= "Informe o nome do paciente\n";
		}
		if(!$valor){
			$erros = TRUE;
			$mensagem .= "Informe o valor\n";
		}
		if(!$forma){
			$erros = TRUE;
			$mensagem .= "Informe a forma de pagamento\n";
		}

		if(!$taxacomissao){
			$erros = TRUE;
			$mensagem .= "Informe a taxa de comissão\n";
		}
		if(!$quemlancou){
			$erros = TRUE;
			$mensagem .= "Informe quem fez este lançamento\n";
		}


		if(!$erros){
			$itens = array ( //COLOCAMOS OS DADOS PROVENIENTES DO FORM DENTRO DA ARRAY QUE SERÁ ENVIADA AO MODEL
				"datadolancamento" => $datadolancamento,
				"datadaficha"      => $datadaficha,
				"nomepac"          => $nomepac,
				"valor"            => $valor,
				"forma"            => $forma,
				"taxacartao"       => $taxacartao,
				"taxacomissao"     => $taxacomissao,
				"quemlancou"       => $quemlancou,
			);
			$resul = $this->LancamentosM->editarcomuns($idlancamentos, $itens);
			if ($resul){
				$this->session->set_flashdata("sucesso", "Dados editados com sucesso!");
				redirect("lancamentos");
			} else {
				$this->session->set_flashdata("erro", "Houve algum erro na edição. Verifique com o administrador.");
				redirect("lancamentos");
			}
		} else {
			$this->session->set_flashdata("erro", nl2br($mensagem));
			redirect("lancamentos/editarcomuns/".$idlancamentos);
		}
		//FIM DA VERIFICAÇÃO E ENVIO SE TUDO OK
	}

	public function salvar_editar_creditos()
	{
		//CAPTURA DOS DADOS VIA MÉTODO POST
		$idcreditos        = $this->input->post("idcreditos");
		$datadolancamento  = date("Y-m-d");
		$datacru           = $this->input->post("datadaficha");
		$ano               = substr($datacru, -4, 4);
		$mes               = substr($datacru, -7, 2);
		$dia               = substr($datacru, -10, 2);
		$datadaficha       = $ano."-".$mes."-".$dia;
		$observacoes       = $this->input->post("observacoes");
		$valor             = number_format($this->moedabrl_para_moedausd($this->input->post("valor")), 2, '.', '');
		$quemlancou        = $this->input->post("quemlancou");

		//VERIFICAÇÃO SE OS DADOS VIERAM
		$erros    = FALSE;
		$mensagem = null;
		
		if(!$datacru){
			$erros = TRUE;
			$mensagem .= "Informe a data\n";
		}
		if(!$observacoes){
			$erros = TRUE;
			$mensagem .= "Informe as Observações\n";
		}
		if(!$valor){
			$erros = TRUE;
			$mensagem .= "Informe o valor\n";
		}
		if(!$quemlancou){
			$erros = TRUE;
			$mensagem .= "Informe quem fez este lançamento\n";
		}


		if(!$erros){
			$itens = array ( //COLOCAMOS OS DADOS PROVENIENTES DO FORM DENTRO DA ARRAY QUE SERÁ ENVIADA AO MODEL
				"datadolancamento" => $datadolancamento,
				"datadaficha"      => $datadaficha,
				"observacoes"      => $observacoes,
				"valor"            => $valor,
				"quemlancou"       => $quemlancou,
			);

			$resul = $this->LancamentosM->editarcreditos($idcreditos, $itens);
			if ($resul){
				$this->session->set_flashdata("sucesso", "Dados editados com sucesso!");
				redirect("lancamentos");
			} else {
				$this->session->set_flashdata("erro", "Houve algum erro na edição. Verifique com o administrador.");
				redirect("lancamentos");
			}
		} else {
			$this->session->set_flashdata("erro", nl2br($mensagem));
			redirect("lancamentos/editarcreditos/".$idcreditos);
		}
		//FIM DA VERIFICAÇÃO E ENVIO SE TUDO OK
	}

	public function salvar_editar_debitos()
	{
		//CAPTURA DOS DADOS VIA MÉTODO POST
		$iddebitos        = $this->input->post("iddebitos");
		$datadolancamento  = date("Y-m-d");
		$datacru           = $this->input->post("datadaficha");
		$ano               = substr($datacru, -4, 4);
		$mes               = substr($datacru, -7, 2);
		$dia               = substr($datacru, -10, 2);
		$datadaficha       = $ano."-".$mes."-".$dia;
		$observacoes       = $this->input->post("observacoes");
		$valor             = number_format($this->moedabrl_para_moedausd($this->input->post("valor")), 2, '.', '');
		$quemlancou        = $this->input->post("quemlancou");

		
		//VERIFICAÇÃO SE OS DADOS VIERAM
		$erros    = FALSE;
		$mensagem = null;
		
		if(!$datacru){
			$erros = TRUE;
			$mensagem .= "Informe a data\n";
		}
		if(!$observacoes){
			$erros = TRUE;
			$mensagem .= "Informe as Observações\n";
		}
		if(!$valor){
			$erros = TRUE;
			$mensagem .= "Informe o valor\n";
		}
		if(!$quemlancou){
			$erros = TRUE;
			$mensagem .= "Informe quem fez este lançamento\n";
		}


		if(!$erros){
			$itens = array ( //COLOCAMOS OS DADOS PROVENIENTES DO FORM DENTRO DA ARRAY QUE SERÁ ENVIADA AO MODEL
				"datadolancamento" => $datadolancamento,
				"datadaficha"      => $datadaficha,
				"observacoes"      => $observacoes,
				"valor"            => $valor,
				"quemlancou"       => $quemlancou,
			);

			$resul = $this->LancamentosM->editardebitos($iddebitos, $itens);
			if ($resul){
				$this->session->set_flashdata("sucesso", "Dados editados com sucesso!");
				redirect("lancamentos");
			} else {
				$this->session->set_flashdata("erro", "Houve algum erro na edição. Verifique com o administrador.");
				redirect("lancamentos");
			}
		} else {
			$this->session->set_flashdata("erro", nl2br($mensagem));
			redirect("lancamentos/editardebitos/".$iddebitos);
		}
		//FIM DA VERIFICAÇÃO E ENVIO SE TUDO OK
	}

	public function salvar_editar_debitos_clinica()
	{
		//CAPTURA DOS DADOS VIA MÉTODO POST
		$iddebitos        = $this->input->post("iddebitosclinica");
		$datadolancamento  = date("Y-m-d");
		$datacru           = $this->input->post("datadaficha");
		$ano               = substr($datacru, -4, 4);
		$mes               = substr($datacru, -7, 2);
		$dia               = substr($datacru, -10, 2);
		$datadaficha       = $ano."-".$mes."-".$dia;
		$observacoes       = $this->input->post("observacoes");
		$valor             = number_format($this->moedabrl_para_moedausd($this->input->post("valor")), 2, '.', '');
		$quemlancou        = $this->input->post("quemlancou");

		
		//VERIFICAÇÃO SE OS DADOS VIERAM
		$erros    = FALSE;
		$mensagem = null;
		
		if(!$datacru){
			$erros = TRUE;
			$mensagem .= "Informe a data\n";
		}
		if(!$observacoes){
			$erros = TRUE;
			$mensagem .= "Informe as Observações\n";
		}
		if(!$valor){
			$erros = TRUE;
			$mensagem .= "Informe o valor\n";
		}
		if(!$quemlancou){
			$erros = TRUE;
			$mensagem .= "Informe quem fez este lançamento\n";
		}


		if(!$erros){
			$itens = array ( //COLOCAMOS OS DADOS PROVENIENTES DO FORM DENTRO DA ARRAY QUE SERÁ ENVIADA AO MODEL
				"datadolancamento" => $datadolancamento,
				"datadaficha"      => $datadaficha,
				"observacoes"      => $observacoes,
				"valor"            => $valor,
				"quemlancou"       => $quemlancou,
			);

			$resul = $this->LancamentosM->editardebitosclinica($iddebitos, $itens);
			if ($resul){
				$this->session->set_flashdata("sucesso", "Dados editados com sucesso!");
				redirect("lancamentos");
			} else {
				$this->session->set_flashdata("erro", "Houve algum erro na edição. Verifique com o administrador.");
				redirect("lancamentos");
			}
		} else {
			$this->session->set_flashdata("erro", nl2br($mensagem));
			redirect("lancamentos/editardebitosclinica/".$iddebitos);
		}
		//FIM DA VERIFICAÇÃO E ENVIO SE TUDO OK
	}

	private function corrigir_ano($ano_chucro)
	{
		$ano = substr($ano_chucro, -10, 4);
		$mes = substr($ano_chucro, -5, 2);
		$dia = substr($ano_chucro, -2, 2);
		$datacorrigida = $dia."/".$mes."/".$ano;
		return $datacorrigida;
	}

	private function valor_liquido($valorbruto, $taxacartao, $taxacomissao)
	{
		if($taxacartao == 0.00){
			$resultado = ($valorbruto*$taxacomissao)/100;
			return number_format($resultado, 2, '.', ''); 
		} else {
			$resultado = (($valorbruto-($valorbruto*($taxacartao/100)))*$taxacomissao)/100;
			return number_format($resultado, 2, '.', '');
		}
	}

	private function moedabrl_para_moedausd($valor_cru)
	{
		$source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $valor_cru);
        return $valor;
	}

	private function somente_cheques_menores($comissao_dentista)
	{
		$array_de_cheques = $this->LancamentosM->pegar_todos_cheques_array();
		$resposta = null;

		foreach($array_de_cheques as $key=>$cheque){
		
			if($cheque > $comissao_dentista){
				unset($array_de_cheques[$key]);
			}
		}
		return $array_de_cheques;
	}

	private function milagre($dinheirovivo, $comissao_dentista)
	{
		$resposta      = array();
		$closest     = null;
		$closest_key = null;

		$array_de_cheques = $this->somente_cheques_menores($comissao_dentista);

		foreach ($array_de_cheques as $key=>$cheque) {
			if ($closest === null || abs($comissao_dentista - $closest) > abs($cheque - $comissao_dentista)) {
				$closest = $cheque;
				$closest_key = $key;
			}
   		}
   		

		unset($array_de_cheques[$closest_key]);
   		
		
		$somatorio     = null;
		$quanto_faltou = null;
   
		foreach ($array_de_cheques as $cheque) {

			if (!($closest+$cheque > $comissao_dentista)) {
				if ($somatorio+$closest+$cheque <= $comissao_dentista && $somatorio+$closest+$cheque+$dinheirovivo >= $comissao_dentista ) {
					$resultado["liberacao"]      = TRUE;
					return $resultado;
				} else {
					($closest+$somatorio+$cheque < $comissao_dentista ? $somatorio+=$cheque : null);
					$quanto_faltou = $comissao_dentista-($closest+$somatorio+$dinheirovivo);
				}
			}
		}

   		$resposta["liberacao"]      = FALSE;
   		$resposta["quanto_faltou"] = $quanto_faltou; 
   		return $resposta;
	}
}