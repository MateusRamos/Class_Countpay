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

	
    //==================================================== CRIAR CARTÃO =====================================================//
	public static function criaCartao($dadosCartao, $id_usuario, $id_instituicao)
	{

		$sql = new Sql();

		$resultado = $sql->select("CALL sp_cartao_inserir(:APELIDO, :TIPO_CARTAO, :VENCE_DIA, :LIMITE, :ID_USUARIO, :ID_INSTITUICAO)", array(
			':APELIDO'=>$dadosCartao['apelido'],
			':TIPO_CARTAO'=>$dadosCartao['tipo_cartao'],
			':VENCE_DIA'=>$dadosCartao['vence_dia'],
			':LIMITE'=>$dadosCartao['limite'],
			':ID_USUARIO'=>$id_usuario,
			':ID_INSTITUICAO'=>$id_instituicao
		));

	}


    //=================================================== ALTERA CARTÃO =====================================================//
	public static function alteraCartao($dadosCartao, $instituicao)
	{

		$sql = new Sql();

		$sql->execQuery("UPDATE cartao SET apelido = :APELIDO, tipo_cartao = :TIPO_CARTAO, vence_dia = :VENCE_DIA, limite = :LIMITE, id_instituicao = :ID_INSTITUICAO WHERE id_cartao = :ID_CARTAO", array(
			':ID_CARTAO'=>$dadosCartao['id_cartao'],
			':APELIDO'=>$dadosCartao['apelido'],
			':TIPO_CARTAO'=>$dadosCartao['tipo_cartao'],
			':VENCE_DIA'=>$dadosCartao['vence_dia'],
			':LIMITE'=>$dadosCartao['limite'],
			':ID_INSTITUICAO'=>$instituicao,
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


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	    FUNÇÕES DE LISTAGEM                                                  ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//===================================================== INSTITUIÇÃO =====================================================//
	public static function listaInstituicao()
	{
		$sql = new Sql();

		return $sql->select("SELECT nome FROM instituicao ORDER BY id_instituicao ASC, nome ASC");

	}


	//======================================================== CARTAO ======================================================//
	public static function listaCartao($id_usuario)
	{
		$sql = new Sql();

		$cartao = $sql->select(
		"SELECT cartao.id_cartao, cartao.apelido, cartao.tipo_cartao, cartao.vence_dia, cartao.limite, instituicao.nome
		FROM cartao
		INNER JOIN instituicao ON instituicao.id_instituicao = cartao.id_instituicao AND cartao.id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));
		
		return $cartao;
	}


	//======================================================== CONTA =======================================================//
	public static function listaConta($id_usuario)
	{
		$sql = new Sql();

		// Select com os campos coletados do frente e verificando se existe no banco de dados
		$contas = $sql->select( 
			"SELECT conta.id_conta, conta.apelido, instituicao.nome, conta.tipo_conta, conta.saldo
			FROM conta
			INNER JOIN instituicao ON instituicao.id_instituicao = conta.id_instituicao AND conta.id_usuario = :ID_USUARIO", array(
				":ID_USUARIO"=>$id_usuario
		));
		
		return $contas;
	}


	//================================================ CONTA - APELIDO SELECT ==============================================//
	public static function listaApelidoCartao($id_usuario)
	{

		$sql = new Sql();

		return $sql->select("SELECT apelido FROM cartao WHERE id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));

	}

	
	//================================================ CARTAO - APELIDO SELECT =============================================//
	public static function listaApelidoConta($id_usuario)
	{

		$sql = new Sql();

		return $sql->select("SELECT apelido FROM conta WHERE id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));

	}


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										     FUNÇÕES DE CONVERSÃO STRING -> ID                                           ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//===================================================== INSTITUIÇÃO =====================================================//
	public static function buscaInstituicao($dadosCartao)
	{
		$sql = new Sql();

		$instituicao = $sql->select("SELECT id_instituicao FROM instituicao WHERE nome = :NOME", array(
			":NOME"=>$dadosCartao['instituicao']
		));

		// Verificação se os dados foi recebido, se sim realizar o armazenamento do id selecionado pelo usuário, caso não foi selecionado o campo fica vazio
		if (!empty($instituicao))
		{
			return $instituicao[0]['id_instituicao'];
		} else {
			return NULL;
		}
	
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

	

}
?>

