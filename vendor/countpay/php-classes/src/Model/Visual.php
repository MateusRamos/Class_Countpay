<?php 
namespace Countpay\Model;

use \Countpay\DB\Sql;

class Visual {


	#                                                  ╔═══════════════════╗
	#									 	           ║  CALCULO DE DATA  ║
	#                                                  ╚═══════════════════╝

	//Retorna uma mensagem escolhida e manda o usuário para uma rota escolhida;
	public static function mostraMensagem($mensagem, $rota)
	{
		echo "<script language='javascript' type='text/javascript'> alert('" .$mensagem. "');window.location.href='" . $rota . "';</script>";
	}


	#                                                  ╔═══════════════════╗
	#									 	           ║  CALCULO DE DATA  ║
	#                                                  ╚═══════════════════╝

	//Verifica se uma data qualquer é hoje, ja passou ou ainda vai chegar;
	public static function verificaVencimento($data)
	{

		$hoje = strtotime(date("Y-m-d"));
		$data_int = strtotime($data);
		
		if ($data_int < $hoje)
		{
			return "ontem";
		} 
		elseif($data_int > $hoje)
		{
			return "amanha";
		}
		else
		{
			return "hoje";
		}

	}
	

	//Retorna o tempo em "hoje", "x dias", "x meses" ou "x anos";
	public static function calculaTempoDia($data)
	{

		$data_atual = strtotime(date('Y-m-d H:i:s'));
		$diferenca_tempo = $data_atual - strtotime($data);

		if($diferenca_tempo < 86400)
		{
			return "Hoje";

		} 
		else if($diferenca_tempo>=86400 && $diferenca_tempo<(86400*30))
		{
			return round($diferenca_tempo/86400).' dias';

		} 
		elseif($diferenca_tempo>=(86400*30) && $diferenca_tempo<(86400*365))
		{
			return round($diferenca_tempo/(86400*30)).' meses';
		}
		else
		{
			return round($diferenca_tempo/(86400*365)).' anos';
		}

	}


	#                                                  ╔═══════════════════╗
	#									 	           ║  CALCULO DE COR   ║
	#                                                  ╚═══════════════════╝

    //Retorna verde, vermelho ou azul dependendo do tipo de lançamento;
    public static function setCorLancamento($tipo_lancamento)
    {
        $results = substr($tipo_lancamento, 0, 7);

        if($results == "Receita"){
            return "#26A234";
        } 
        elseif($results == "Despesa")
        {
            return "#E54640";
        }
        else
        {
            return "#0AA8D0";
        }
        
    }


	#                                                  ╔═════════════════════╗
	#									 	           ║  CALCULO DE DADOS   ║
	#                                                  ╚═════════════════════╝

	//Retorna o total de valor (receita) do usuário;
	public static function calculaReceitaUsuario($id_usuario)
	{

		$sql = new Sql();

		return $sql->select("SELECT SUM(valor) 'receita' FROM lancamento WHERE id_usuario = :ID_USUARIO AND status_lancamento = 0 AND tipo_lancamento LIKE '%Receita%' ", array(
			":ID_USUARIO"=>$id_usuario
		));

	}

	//Retorna o total de valor (despesa) do usuário;
	public static function calculaDespesaUsuario($id_usuario)
	{

		$sql = new Sql();

		return $sql->select("SELECT SUM(valor) 'despesa' FROM lancamento WHERE id_usuario = :ID_USUARIO AND status_lancamento = 0 AND tipo_lancamento LIKE '%Despesa%' ", array(
			":ID_USUARIO"=>$id_usuario
		));

	}


	//Retorna o total de valor (receita) do usuário;
	public static function calculaTransferenciaUsuario($id_usuario)
	{

		$sql = new Sql();

		return $sql->select("SELECT SUM(valor) 'transferencia' FROM lancamento WHERE id_usuario = :ID_USUARIO AND id_categoria = 31 ", array(
			":ID_USUARIO"=>$id_usuario
		));

	}


	//Retorna o total de usuários do sistema (normais e adm);
	public static function calculaTotalUsuarios()
	{

		$sql = new Sql();

		return $sql->select("SELECT COUNT(id_usuario) 'dados' FROM usuario");

	}


	//Retorna o total de cartões cadastrados no sistema;
	public static function calculaTotalCartoes()
	{

		$sql = new Sql();

		return $sql->select("SELECT COUNT(id_cartao) 'dados' FROM cartao");

	}
	

	//Retorna o total de contas cadastradas no sistema;
	public static function calculaTotalContas()
	{

		$sql = new Sql();

		return $sql->select("SELECT COUNT(id_conta) 'dados' FROM conta");

	}


	//Retorna o total de lançamentos já feitos no sistema;
	public static function calculaTotalLancamentos()
	{

		$sql = new Sql();

		return $sql->select("SELECT COUNT(id_lancamento) 'dados' FROM lancamento");

	}

	#                                                  ╔══════════════════════╗
	#									 	           ║  LISTAGEM DE DADOS   ║
	#                                                  ╚══════════════════════╝
	    
    //Lista os ultimos 6 lançamentos do usuário, status = 0;
	public static function listaUltimosLancamentos($id_usuario)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT descricao_lancamento, tipo_lancamento, valor, data_lancamento FROM lancamento 
								WHERE status_lancamento = 0 AND id_usuario = :ID_USUARIO AND data_lancamento <= current_date()  
								order by data_lancamento desc limit 6", array(
									":ID_USUARIO"=>$id_usuario
								));

		if(count($results) > 0)	
		{
			foreach($results as $key => $value)
			{
				$results[$key]['tempo'] = Visual::calculaTempoDia($results[$key]['data_lancamento']);

				$results[$key]['cor'] = Visual::setCorLancamento($results[$key]['tipo_lancamento']);

				$results[$key]['tipo_lancamento'] = $results[$key]['tipo_lancamento'] . " :";
				$results[$key]['descricao_lancamento'] = $results[$key]['descricao_lancamento'] . " - ";
			}

			for($i=count($results); $i <= 5; $i++)
			{
				$results[$i]["descricao_lancamento"] = "Aguardando Lançamento...";
				$results[$i]["tipo_lancamento"] = "";
				$results[$i]["valor"] = "";
				$results[$i]["data_lancamento"] = "";
				$results[$i]["tempo"] = "";
				$results[$i]["cor"] = "";

			}

		}
		else 
		{

			for($i=0; $i <= 5; $i++)
			{
				$results[$i]["descricao_lancamento"] = "Aguardando Lançamento...";
				$results[$i]["tipo_lancamento"] = "";
				$results[$i]["valor"] = "";
				$results[$i]["data_lancamento"] = "";
				$results[$i]["tempo"] = "";
				$results[$i]["cor"] = "";

			}
		}
			
		return $results;

	}


	#                                                  ╔══════════════════════╗
	#									 	           ║  VISUAL DO DASHBOARD ║
	#                                                  ╚══════════════════════╝


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
		$status_lancamento = 0;

		$results = $sql->select("CALL sp_coleta_dados_status (:ID_USUARIO, :DATA_INICIAL, :DATA_FINAL, :STATUS)", array(
			":ID_USUARIO"=>$id_usuario,
			":DATA_INICIAL"=>$data_inicial,
			":DATA_FINAL"=>$data_final,
			":STATUS"=>$status_lancamento
		));

		
		$dados = array(
			"receita"=>0,
			"despesa"=>0
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
			}
		}

		return $dados;
	}

}
?>