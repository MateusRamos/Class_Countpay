<?php 
namespace Countpay\Model;

use \Countpay\DB\Sql;
use \Countpay\Model;



class Carteira extends Model{

	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	      FUNÇÕES CARTÃO                                                     ||
	||												    																	 ||
	//===========================================================|===========================================================*/
	
    //==================================================== CRIAR CARTÃO =====================================================//
	public static function criaCartao($dados_catao, $id_usuario)
	{

		$sql = new Sql();

		$resultado = $sql->select("CALL sp_cartao_inserir(:APELIDO, :TIPO_CARTAO, :VENCE_DIA, :LIMITE, :ID_USUARIO, :ID_INSTITUICAO)", array(
			':APELIDO'=>$dados_catao['apelido'],
			':TIPO_CARTAO'=>$dados_catao['tipo_cartao'],
			':VENCE_DIA'=>$dados_catao['vence_dia'],
			':LIMITE'=>$dados_catao['limite'],
			':ID_USUARIO'=>$id_usuario,
			':ID_INSTITUICAO'=>$dados_catao['instituicao']
		));

	}


    //=================================================== ALTERA CARTÃO =====================================================//
	public static function alteraCartao($dadosCartao, $id_instituicao)
	{

		$sql = new Sql();

		$sql->execQuery("UPDATE cartao SET apelido = :APELIDO, tipo_cartao = :TIPO_CARTAO, vence_dia = :VENCE_DIA, limite = :LIMITE, id_instituicao = :ID_INSTITUICAO WHERE id_cartao = :ID_CARTAO", array(
			':ID_CARTAO'=>$dadosCartao['id_cartao'],
			':APELIDO'=>$dadosCartao['apelido'],
			':TIPO_CARTAO'=>$dadosCartao['tipo_cartao'],
			':VENCE_DIA'=>$dadosCartao['vence_dia'],
			':LIMITE'=>$dadosCartao['limite'],
			':ID_INSTITUICAO'=>$id_instituicao,
		));

	}


    //=================================================== EXCLUI CARTÃO =====================================================//
	public static function deletaCartao($id_cartao)
	{

		$sql->execQuery("DELETE FROM cartao WHERE id_cartao = :ID_CARTAO", array(
			':ID_CARTAO'=>$id_cartao
		));
	
	}

	
	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	       FUNÇÕES CONTA                                                     ||
	||												    																	 ||
	//===========================================================|===========================================================*/



    //====================================================== CRIAR CONTA =====================================================//
	public static function criaConta($dadosConta, $instituicao, $id_usuario)
	{	

		$sql = new Sql();
		
		return $sql->select("CALL sp_conta_inserir(:APELIDO, :TIPO_CONTA, :SALDO, :ID_USUARIO, :ID_INSTITUICAO)", array(
			':APELIDO'=>$dadosConta['apelido'],
			':TIPO_CONTA'=>$dadosConta['tipo_conta'],
			':SALDO'=>$dadosConta['valor'],
			':ID_USUARIO'=>$id_usuario,
			':ID_INSTITUICAO'=>$instituicao
		));

	}


    //===================================================== ALTERAR CONTA ====================================================//
	public static function alteraConta($dadosConta, $instituicao)
	{

		$sql = new Sql();

		$sql->execQuery("UPDATE conta SET apelido = :APELIDO, tipo_conta = :TIPO_CONTA, saldo = :SALDO, id_instituicao = :ID_INSTITUICAO WHERE id_conta = :ID_CONTA", array(

			':ID_CONTA'=>$dadosConta['id_conta'],
			':APELIDO'=>$dadosConta['apelido'],
			':TIPO_CONTA'=>$dadosConta['tipo_conta'],
			':SALDO'=>$dadosConta['valor'],
			':ID_INSTITUICAO'=>$instituicao,
			
		));

	}


    //===================================================== EXCLUI CONTA =====================================================//
	public static function deletaConta($id_conta)
	{
		$sql = new Sql();

		$sql->execQuery("DELETE FROM conta WHERE id_conta = :ID_CONTA", array(
			':ID_CONTA'=>$id_conta
		));
	
	}


	public static function atualizaSaldoConta($dados_lancamento, $array_id)
	{
		$sql = new Sql();
		
		$tipo_lancamento = substr($dados_lancamento['tipo_lancamento'], 0, 7);

		if($tipo_lancamento == "Receita" && isset($array_id['id_conta']))
		{

			$sql->execQuery("UPDATE conta SET saldo = ( (SELECT saldo FROM conta WHERE id_conta = :ID_CONTA) + :ENTRADA ) WHERE id_conta = :ID_CONTA", array(
				":ID_CONTA" => $array_id['id_conta'],
				":ENTRADA" => $dados_lancamento['valor']
			));

		}
		else if ($tipo_lancamento == "Despesa" && isset($array_id['id_conta']))
		{
			$entrada = $dados_lancamento['valor'] * -1;
			
			$sql->execQuery("UPDATE conta SET saldo = ( (SELECT saldo FROM conta WHERE id_conta = :ID_CONTA) + :ENTRADA ) WHERE id_conta = :ID_CONTA", array(
				":ID_CONTA" => $array_id['id_conta'],
				":ENTRADA" => $entrada
			));

		}
		
	}


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	    FUNÇÕES DE LISTAGEM                                                  ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//======================================================== CARTAO ======================================================//
	public static function listaCartao($id_usuario)
	{

		$sql = new Sql();

		return $sql->select(
		"SELECT cartao.id_cartao, cartao.apelido, cartao.tipo_cartao, cartao.vence_dia, cartao.limite, instituicao.nome
		FROM cartao
		INNER JOIN instituicao ON instituicao.id_instituicao = cartao.id_instituicao AND cartao.id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));
	
	}


	//======================================================== CONTA =======================================================//
	public static function listaConta($id_usuario)
	{

		$sql = new Sql();

		// Select com os campos coletados do frente e verificando se existe no banco de dados
		return $sql->select( 
			"SELECT conta.id_conta, conta.apelido, instituicao.nome, conta.tipo_conta, conta.saldo
			FROM conta
			INNER JOIN instituicao ON instituicao.id_instituicao = conta.id_instituicao AND conta.id_usuario = :ID_USUARIO", array(
				":ID_USUARIO"=>$id_usuario
		));
		
	}
	

	//================================================ CONTA - APELIDO SELECT ==============================================//
	public static function listaApelidoCartao($id_usuario)
	{

		$sql = new Sql();

		return $sql->select("SELECT apelido, id_cartao FROM cartao WHERE id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));

	}

	
	//================================================ CARTAO - APELIDO SELECT =============================================//
	public static function listaApelidoConta($id_usuario)
	{

		$sql = new Sql();

		return $sql->select("SELECT apelido, id_conta FROM conta WHERE id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));

	}

	
	//****************************************** */ INSTITUIÇÃO **************************************************************
	public static function listaInstituicao()
	{

		$sql = new Sql();

		return $sql->select("SELECT nome, id_instituicao FROM instituicao ORDER BY id_instituicao ASC, nome ASC");

	}


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										         FUNÇÕES DE BUSCA/ALTERAÇÃO                                              ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//============================================= CARREGA DADOS PARA O FORM ===============================================//
	public static function carregaDadosCartao($id_cartao) 
	{
		
		$sql = new Sql();

		$results = $sql->select("SELECT id_cartao, apelido, tipo_cartao, vence_dia, limite, id_instituicao FROM cartao WHERE id_cartao = :ID_CARTAO",
		array(
			":ID_CARTAO"=>$id_cartao
		));

		return $results[0];

	}


	//======================================================== CARTAO ======================================================//
	public static function buscaCartao($apelidoCartao, $id_usuario)
	{

		$sql = new Sql();

		$id_cartao =  $sql->select("SELECT id_cartao FROM cartao WHERE apelido = :APELIDO AND id_usuario = :ID_USUARIO", array (
		":APELIDO"=>$apelidoCartao,
		':ID_USUARIO'=>$id_usuario
		));

		if (!empty($id_cartao)){
			return $id_cartao[0]['id_cartao'];
		} else {
			return NULL;
		}

	}


	//================================================ CARREGA DADOS PARA O FORM =============================================//
	public static function carregaDadosConta($id_conta)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT id_conta, apelido, tipo_conta, saldo, id_instituicao  FROM conta WHERE id_conta = :ID_CONTA",
		array(
			":ID_CONTA"=>$id_conta
		));

		return $results;

	}


	//======================================================== CONTA =======================================================//
	public static function buscaConta($apelidoConta, $id_usuario)
	{

		$sql = new Sql();

		$id_conta = $sql->select("SELECT id_conta FROM conta WHERE apelido = :APELIDO AND id_usuario = :ID_USUARIO", array (
		":APELIDO"=>$apelidoConta,
		':ID_USUARIO'=>$id_usuario
		));

		if (!empty($id_conta)){
			return $id_conta[0]['id_conta'];
		} else {
			return NULL;
		}	

	}

	
	//===================================================== INSTITUIÇÃO =====================================================//
	public static function buscaInstituicao($dados)
	{	
		$sql = new Sql();

		$instituicao = $sql->select("SELECT id_instituicao FROM instituicao WHERE nome = :NOME", array(
			":NOME"=>$dados['instituicao']
		));

		// Verificação se os dados foi recebido, se sim realizar o armazenamento do id selecionado pelo usuário, caso não foi selecionado o campo fica vazio
		if (!empty($instituicao))
		{
			return $instituicao[0]['id_instituicao'];
		} else {
			return NULL;
		}
	
	}
	








}
?>

