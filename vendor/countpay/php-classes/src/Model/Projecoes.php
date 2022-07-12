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

		return $dados;
	}


	public static function coletaDadosFixo($meses_aux, $id_usuario)
	{

		$fixo_passado = array(
			"receita"=>0,
			"despesa"=>0,
			"fatura"=>0
		);

		foreach($meses_aux as $key => $value)
		{

			$fixo_atual = Projecoes::buscaFixoMesAtual($id_usuario, $key);

			$meses_aux[$key]['receita'] = $meses_aux[$key]['receita'] + $fixo_atual['receita'] + $fixo_passado['receita'];
			$meses_aux[$key]['despesa'] = $meses_aux[$key]['despesa'] + $fixo_atual['despesa'] + $fixo_passado['despesa'];
			$meses_aux[$key]['fatura'] = $meses_aux[$key]['fatura'] + $fixo_atual['fatura'] + $fixo_passado['fatura'];
			
			$fixo_passado['receita'] = $fixo_passado['receita'] + $fixo_atual['receita'];
			$fixo_passado['despesa'] = $fixo_passado['despesa'] + $fixo_atual['despesa'];
			$fixo_passado['fatura'] = $fixo_passado['fatura'] + $fixo_atual['fatura'];

		}

		return $meses_aux;

	}


	public static function buscaFixoMesAtual($id_usuario, $mes)
	{

		$sql = new Sql();

		$data_inicial = date("Y") . "-" . $mes . "-01";
		$data_final = date("Y-m-t", strtotime($data_inicial));

		$results = $sql->select("CALL sp_coleta_dados_fixo(:ID_USUARIO, :DATA_INICIAL, :DATA_FINAL)", array(
			":ID_USUARIO"=>$id_usuario,
			":DATA_INICIAL"=>$data_inicial,
			":DATA_FINAL"=>$data_final
		));

		$mes_atual = array(
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

		}

		return $mes_atual;
	}

}


?>

