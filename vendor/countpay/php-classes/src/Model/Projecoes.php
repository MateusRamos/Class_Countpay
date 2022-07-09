<?php 
namespace Countpay\Model;

use \Countpay\DB\Sql;

class Projecoes {

	#                                                  ╔═══════════════════════╗
	#									 	           ║     	 GERAL         ║
	#                                                  ╚═══════════════════════╝

	
	public static function coletaDadosMes($id_usuario)
	{

		$meses = array(
			"01"=>"01",
			"02"=>"02",
			"03"=>"03",
			"04"=>"04",
			"05"=>"05",
			"06"=>"06",
			"07"=>"07",
			"08"=>"08",
			"09"=>"09",
			"10"=>"10",
			"11"=>"11",
			"12"=>"12"
		);

		foreach($meses as $key => $value)
		{
			if($key == "01" || $key == "03" || $key == "05" || $key == "07" || $key == "08" || $key == "10" || $key == "12")
			{
				$meses[$key] = Projecoes::coletaDados($id_usuario, $value, "31");  
			}
			else if($key == "04" || $key == "06" || $key == "09" || $key == "11")
			{
				$meses[$key] = Projecoes::coletaDados($id_usuario, $value, "30");
			}
			else
			{
				$ano = date("Y");

				if(($ano % 400 == 0) || ($ano % 4 == 0) && ($ano % 100 != 0))
				{
					$meses[$key] = Projecoes::coletaDados($id_usuario, $value, "29");
				}
				else
				{
					$meses[$key] = Projecoes::coletaDados($id_usuario, $value, "28");
				}
			}
		}

		return $meses;

	}



	public static function coletaDados($id_usuario, $mes, $dia_final)
	{

		$sql = new Sql();

		$ano = date("Y");

		$data_inicial = $ano ."-". $mes ."-01";
		$data_final = $ano ."-". $mes ."-". $dia_final;

		$results = $sql->select("CALL sp_coleta_dados_meses (:ID_USUARIO, :DATA_INICIAL, :DATA_FINAL)", array(
			":ID_USUARIO"=>$id_usuario,
			":DATA_INICIAL"=>$data_inicial,
			":DATA_FINAL"=>$data_final
		));

		
		$dados = array(
			"receita"=>0,
			"despesa"=>0,
			"fatura"=>0,
		);

		foreach($results as $key => $value)
		{
			$tipo_lancamento = substr($results[$key]['tipo_lancamento'], 0, 7);

			if($tipo_lancamento == "Receita")
			{
				$dados['receita'] = $dados['receita'] + $results[$key]['valor'];
			}
			else
			{
				$dados['despesa'] = $dados['despesa'] + $results[$key]['valor'];

				if($results[$key]['id_cartao'] != NULL)
				{
					$dados['fatura'] = $dados['fatura'] + $results[$key]['valor'];
				}
			}
		}
		echo json_encode($data_final);


		return $dados;

	}


	public static function coletaDadosFixo($meses_aux, $id_usuario)
	{

		$mes_atual = Projecoes::buscaFixoMesAtual($id_usuario);

		$mes_futuro = Projecoes::buscaFixoFuturo($id_usuario, $mes_atual);

		$meses = array(
			"receita"=>0,
			"despesa"=>0,
			"fatura"=>0
		);

		foreach($meses_aux as $key => $value)
		{

			if($key == date("m"))
			{
				$meses[$key]['receita'] = $meses_aux[$key]['receita'] + $mes_atual['receita'];
				$meses[$key]['despesa'] = $meses_aux[$key]['despesa'] + $mes_atual['despesa'];
				$meses[$key]['fatura'] = $meses_aux[$key]['fatura'] + $mes_atual['fatura'];
			}
			else if($key > date("m"))
			{
				$meses[$key]['receita'] = $meses_aux[$key]['receita'] + $mes_futuro['receita'];
				$meses[$key]['despesa'] = $meses_aux[$key]['despesa'] + $mes_futuro['despesa'];
				$meses[$key]['fatura'] = $meses_aux[$key]['fatura'] + $mes_futuro['fatura'];
			}
			else
			{
				$meses[$key]['receita'] = $meses_aux[$key]['receita'];
				$meses[$key]['despesa'] = $meses_aux[$key]['despesa'];
				$meses[$key]['fatura'] = $meses_aux[$key]['fatura'];
			}

		}

		return $meses;
	}


	public static function buscaFixoMesAtual($id_usuario)
	{

		$sql = new Sql();

		$data_atual = date("Y-m-");
		$data_inicial_atual = $data_atual . "01";
		$data_final_atual = date("Y-m-t", strtotime($data_inicial_atual));

		$results = $sql->select("CALL sp_coleta_dados_fixo(:ID_USUARIO, :DATA_INICIAL, :DATA_FINAL)", array(
			":ID_USUARIO"=>$id_usuario,
			":DATA_INICIAL"=>$data_inicial_atual,
			":DATA_FINAL"=>$data_final_atual
		));

		$mes_atual = array(
			"receita"=>0,
			"despesa"=>0,
			"fatura"=>0,
			"atual"=>0
		);
		
		if(count($results) > 0)
		{
			foreach($results as $key => $value)
			{
				$tipo_lancamento = substr($results[$key]['tipo_lancamento'], 0, 7);
	
				if($tipo_lancamento == "Receita")
				{
					$mes_atual['receita'] = $mes_atual['receita'] + $results[$key]['valor'];
				}
				else
				{
					$mes_atual['despesa'] = $mes_atual['despesa'] + $results[$key]['valor'];
	
					if($results[$key]['id_cartao'] != NULL)
					{
						$mes_atual['fatura'] = $mes_atual['fatura'] + $results[$key]['valor'];
					}
				}
			}

			$mes_atual['atual'] = date("m");
		}

		return $mes_atual;
	}


	public static function buscaFixoFuturo($id_usuario, $mes_atual)
	{
		$data_atual = date("Y-m-d");
		$data_final = date("Y-m-t", strtotime($data_atual));

		$sql = new Sql();

		$results = $sql->select("SELECT  tipo_lancamento, valor, id_cartao FROM lancamento WHERE status_lancamento = 1 AND id_usuario = :ID_USUARIO AND data_lancamento > :DATA_FINAL", array(
			":DATA_FINAL"=>$data_final,
			":ID_USUARIO"=>$id_usuario
		));
		
		$mes_futuro = array(
			"receita"=>0,
			"despesa"=>0,
			"fatura"=>0
		);
		
		if(count($results) > 0)
		{
			foreach($results as $key => $value)
			{
				$tipo_lancamento = substr($results[$key]['tipo_lancamento'], 0, 7);
	
				if($tipo_lancamento == "Receita")
				{
					$mes_futuro['receita'] = $mes_futuro['receita'] + $results[$key]['valor'];
				}
				else
				{
					$mes_futuro['despesa'] = $mes_futuro['despesa'] + $results[$key]['valor'];
	
					if($results[$key]['id_cartao'] != NULL)
					{
						$mes_futuro['fatura'] = $mes_futuro['fatura'] + $results[$key]['valor'];
					}
				}
			}

			$mes_futuro['receita'] = $mes_futuro['receita'] + $mes_atual['receita'];
			$mes_futuro['despesa'] = $mes_futuro['despesa'] + $mes_atual['despesa'];
			$mes_futuro['fatura'] = $mes_futuro['fatura'] + $mes_atual['fatura'];
		}

		return $mes_futuro;

	}

}


?>

