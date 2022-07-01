<?php 
namespace Countpay\Model;

use \Countpay\DB\Sql;

class Carteira {

	#                                                  ╔═══════════════════════╗
	#									 	           ║     	 GERAL         ║
	#                                                  ╚═══════════════════════╝

	public static function atualizaSaldoConta($dados_lancamento)
	{
		
		$sql = new Sql();
		
		$tipo_lancamento = substr($dados_lancamento['tipo_lancamento'], 0, 7);

		if($tipo_lancamento == "Receita" && isset($dados_lancamento['id_conta']))
		{
			
			$sql->execQuery("UPDATE conta SET saldo = ( (SELECT saldo FROM conta WHERE id_conta = :ID_CONTA) + :ENTRADA ) WHERE id_conta = :ID_CONTA", array(
				":ID_CONTA" => $dados_lancamento['id_conta'],
				":ENTRADA" => $dados_lancamento['valor']
			));

		}
		else if ($tipo_lancamento == "Despesa" && isset($dados_lancamento['id_conta']))
		{
			$entrada = $dados_lancamento['valor'] * -1;
			
			$sql->execQuery("UPDATE conta SET saldo = ( (SELECT saldo FROM conta WHERE id_conta = :ID_CONTA) + :ENTRADA ) WHERE id_conta = :ID_CONTA", array(
				":ID_CONTA" => $dados_lancamento['id_conta'],
				":ENTRADA" => $entrada
			));

		}
		
	}


	#                                                  ╔══════════════════════╗
	#									 	           ║     	CARTÃO        ║
	#                                                  ╚══════════════════════╝
	
    //Cria cartão com dados do front;
	public static function criaCartao($dados_cartao, $id_usuario)
	{

		$sql = new Sql();

		$sql->select("CALL sp_cartao_inserir(:APELIDO, :TIPO_CARTAO, :VENCE_DIA, :LIMITE, :ID_USUARIO, :ID_INSTITUICAO)", array(
			':APELIDO'=>$dados_cartao['apelido'],
			':TIPO_CARTAO'=>$dados_cartao['tipo_cartao'],
			':VENCE_DIA'=>$dados_cartao['vence_dia'],
			':LIMITE'=>$dados_cartao['limite'],
			':ID_USUARIO'=>$id_usuario,
			':ID_INSTITUICAO'=>$dados_cartao['id_instituicao']
		));

	}


	//Carrega dados do cartão para o front do alterar cartão;
	public static function carregaDadosCartao($id_cartao) 
	{
		
		$sql = new Sql();

		$results = $sql->select("SELECT id_cartao, apelido, tipo_cartao, vence_dia, limite, id_instituicao FROM cartao WHERE id_cartao = :ID_CARTAO",
		array(
			":ID_CARTAO"=>$id_cartao
		));

		return $results[0];

	}


    //Altera cartão com dados do front;
	public static function alteraCartao($dados_cartao)
	{

		$sql = new Sql();

		$sql->execQuery("UPDATE cartao SET apelido = :APELIDO, tipo_cartao = :TIPO_CARTAO, vence_dia = :VENCE_DIA, limite = :LIMITE, id_instituicao = :ID_INSTITUICAO WHERE id_cartao = :ID_CARTAO", array(
			':ID_CARTAO'=>$dados_cartao['id_cartao'],
			':APELIDO'=>$dados_cartao['apelido'],
			':TIPO_CARTAO'=>$dados_cartao['tipo_cartao'],
			':VENCE_DIA'=>$dados_cartao['vence_dia'],
			':LIMITE'=>$dados_cartao['limite'],
			':ID_INSTITUICAO'=>$dados_cartao['id_instituicao'],
		));

	}


    //Deleta cartão pelo id_cartao;
	public static function deletaCartao($id_cartao)
	{

		$sql = new Sql();

		$sql->execQuery("DELETE FROM cartao WHERE id_cartao = :ID_CARTAO", array(
			':ID_CARTAO'=>$id_cartao
		));
	
	}

	
	#                                                  ╔═══════════════════════╗
	#									 	           ║     	 CONTA         ║
	#                                                  ╚═══════════════════════╝

    //Cria conta com dados do front;
	public static function criaConta($dados_conta, $id_usuario)
	{	

		$sql = new Sql();
		
		return $sql->select("CALL sp_conta_inserir(:APELIDO, :TIPO_CONTA, :SALDO, :ID_USUARIO, :ID_INSTITUICAO)", array(
			':APELIDO'=>$dados_conta['apelido'],
			':TIPO_CONTA'=>$dados_conta['tipo_conta'],
			':SALDO'=>$dados_conta['valor'],
			':ID_USUARIO'=>$id_usuario,
			':ID_INSTITUICAO'=>$dados_conta['id_instituicao']
		));

	}

	
	//Carrega dados do cartão para o front do alterar cartão;
	public static function carregaDadosConta($id_conta)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT id_conta, apelido, tipo_conta, saldo, id_instituicao  FROM conta WHERE id_conta = :ID_CONTA",
		array(
			":ID_CONTA"=>$id_conta
		));

		return $results;

	}


    //Altera conta com dados do front;
	public static function alteraConta($dados_conta)
	{

		$sql = new Sql();

		$sql->execQuery("UPDATE conta SET apelido = :APELIDO, tipo_conta = :TIPO_CONTA, saldo = :SALDO, id_instituicao = :ID_INSTITUICAO WHERE id_conta = :ID_CONTA", array(
			':ID_CONTA'=>$dados_conta['id_conta'],
			':APELIDO'=>$dados_conta['apelido'],
			':TIPO_CONTA'=>$dados_conta['tipo_conta'],
			':SALDO'=>$dados_conta['valor'],
			':ID_INSTITUICAO'=>$dados_conta['id_instituicao'],
		));

	}


    //Delete conta pelo id_conta;
	public static function deletaConta($id_conta)
	{
		$sql = new Sql();

		$sql->execQuery("DELETE FROM conta WHERE id_conta = :ID_CONTA", array(
			':ID_CONTA'=>$id_conta
		));
	
	}


	#                                                  ╔═══════════════════════════════════╗
	#									 	           ║     	  LISTA PARA SELECT        ║
	#                                                  ╚═══════════════════════════════════╝

	//Lista todos os cartões do usuário, para tabela de contas;
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


	//Lista todas as contas do usuário, para tabela de contas;
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
	

	//Lista todos os cartões do usuário, para selects;
	public static function listaApelidoCartao($id_usuario)
	{

		$sql = new Sql();

		return $sql->select("SELECT apelido, id_cartao FROM cartao WHERE id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));

	}

	
	//Lista todas as contas do usuário, para selects;
	public static function listaApelidoConta($id_usuario)
	{

		$sql = new Sql();

		return $sql->select("SELECT apelido, id_conta FROM conta WHERE id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));

	}

	
	//Lista todas as instituições para select do front;
	public static function listaInstituicao()
	{

		$sql = new Sql();

		return $sql->select("SELECT nome, id_instituicao FROM instituicao ORDER BY id_instituicao ASC, nome ASC");

	}


}
?>

