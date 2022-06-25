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
			"janeiro"=>"01",
			"fevereiro"=>"02",
			"marco"=>"03",
			"abril"=>"04",
			"maio"=>"05",
			"junho"=>"06",
			"julho"=>"07",
			"agosto"=>"08",
			"setembro"=>"09",
			"outubro"=>"10",
			"novembro"=>"11",
			"dezembro"=>"12"
		);

		foreach($meses as $key => $value)
		{
			if($key == "janeiro" || $key == "marco" || $key == "maio" || $key == "julho" || $key == "agosto" || $key == "outubro" || $key == "dezembro")
			{
				$meses[$key] = Projecoes::coletaDados($id_usuario, $value, "31");  
			}
			else if($key == "abril" || $key == "junho" || $key == "setembro" || $key == "novembro")
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

	
}


?>

