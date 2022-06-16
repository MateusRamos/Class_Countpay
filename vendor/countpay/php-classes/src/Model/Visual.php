<?php 
namespace Countpay\Model;

use \Countpay\DB\Sql;
use \Countpay\Model;

class Visual extends Model	{


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	     Funções de Calculo                                                  ||
	||												    							 										 ||
	//===========================================================|===========================================================*/

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
	

	//=============================== Função para calcular o tempo de certa data até hoje ===================================//

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


    //=============================== Função para mudar a cor de acordo com o tipo do lancamento ============================//
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


	//==================================== Função para somar os dados x de uma tabela x =====================================//
	public static function calculaTotalUsuarios()
	{

		$sql = new Sql();

		return $sql->select("SELECT COUNT(id_usuario) 'dados' FROM usuario");

	}


	//==================================== Função para somar os dados x de uma tabela x =====================================//
	public static function calculaTotalContas()
	{

		$sql = new Sql();

		return $sql->select("SELECT COUNT(id_conta) 'dados' FROM conta");

	}
	

	//==================================== Função para somar os dados x de uma tabela x =====================================//
	public static function calculaTotalCartoes()
	{

		$sql = new Sql();

		return $sql->select("SELECT COUNT(id_cartao) 'dados' FROM cartao");

	}


	//==================================== Função para somar os dados x de uma tabela x =====================================//
	public static function calculaTotalLancamentos()
	{

		$sql = new Sql();

		return $sql->select("SELECT COUNT(id_lancamento) 'dados' FROM lancamento");

	}

	
	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	     Funções de Listagem                                                 ||
	||												    							 										 ||
	//===========================================================|===========================================================*/
	    
    //=========================================== Função listar todos os usuarios ===========================================//
	public static function listaUltimosLancamentos($id_usuario)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT descricao_lancamento, tipo_lancamento, valor, data_lancamento FROM lancamento 
								WHERE status_lancamento = 0 AND id_usuario = :ID_USUARIO AND data_lancamento < current_date()  
								order by data_lancamento desc limit 6", array(
									":ID_USUARIO"=>$id_usuario
								));

		if(count($results) > 0)
		{
			foreach($results as $key => $value)
			{
				$results[$key]['tempo'] = Visual::calculaTempoDia($results[$key]['data_lancamento']);

				$results[$key]['cor'] = Visual::setCorLancamento($results[$key]['tipo_lancamento']);
			}

			for($i=count($results); $i <= 5; $i++)
			{
				$results[$i]["descricao_lancamento"] = "Aguardando Lançamento";
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
				$results[$i]["descricao_lancamento"] = "Aguardando Lançamento";
				$results[$i]["tipo_lancamento"] = "";
				$results[$i]["valor"] = "";
				$results[$i]["data_lancamento"] = "";
				$results[$i]["tempo"] = "";
				$results[$i]["cor"] = "";

			}
		}
			
		return $results;

	}


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	    Funções de Mensagens                                                 ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//============================== Função para mandar uma mensagem para o usuario por pop-up ==============================//
	public static function mostraMensagem($mensagem, $rota)
	{
		echo "<script language='javascript' type='text/javascript'> alert('" .$mensagem. "');window.location.href='" . $rota . "';</script>";
	}







}
?>