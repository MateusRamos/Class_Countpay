<?php 
namespace Countpay\Model;

use \Countpay\DB\Sql;


class Lancamento {	

	#                                                  ╔══════════════════════════╗
	#									 	           ║     LANÇAMENTO ÚNICO     ║
	#                                                  ╚══════════════════════════╝

	//Corpo de criação de lançamento único;
	public static function iniciaLancamentoUnico($dados_lancamento, $id_usuario)
	{

		$result_verificacao = Visual::verificaVencimento($dados_lancamento['data_lancamento']);

		if($result_verificacao == "amanha")
		{
			Lancamento::criaLancamentoUnicoFuturo($dados_lancamento, $id_usuario);
		}
		else
		{
			Lancamento::criaLancamentoUnico($dados_lancamento, $id_usuario);
		
			Visual::mostraMensagem('Lançamento criado com sucesso!', '/lancamento/historico');
		
		}

	}


	//Cria lançamento futuro, status_lancamento = 2;
	public static function criaLancamentoUnicoFuturo($dados_lancamento, $id_usuario)
	{

		$sql = new Sql();

		$sql->execQuery("INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, status_lancamento)
							VALUES (:DESCRICAO_LANCAMENTO, :TIPO_LANCAMENTO, :VALOR, :DATA_LANCAMENTO, :ID_USUARIO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :STATUS_LANCAMENTO)", array(
							":DESCRICAO_LANCAMENTO"=>$dados_lancamento['descricao_lancamento'],
							":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
							":VALOR"=>$dados_lancamento['valor'],
							":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
							":ID_USUARIO"=>$id_usuario,
							":ID_CONTA"=>$dados_lancamento['id_conta'],
							":ID_CARTAO"=>$dados_lancamento['id_cartao'],
							":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
							":STATUS_LANCAMENTO"=>2
							));

		Visual::mostraMensagem('Lançamento criado com sucesso!', '/lancamento/historico');

	} 


	//Cria lançamento normal, status_lancamento = 0;
	public static function criaLancamentoUnico($dados_lancamento, $id_usuario)
	{

		$sql = new Sql();

		$sql->execQuery("INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, status_lancamento)
							VALUES (:DESCRICAO_LANCAMENTO, :TIPO_LANCAMENTO, :VALOR, :DATA_LANCAMENTO, :ID_USUARIO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :STATUS_LANCAMENTO)", array(
							":DESCRICAO_LANCAMENTO"=>$dados_lancamento['descricao_lancamento'],
							":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
							":VALOR"=>$dados_lancamento['valor'],
							":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
							":ID_USUARIO"=>$id_usuario,
							":ID_CONTA"=>$dados_lancamento['id_conta'],
							":ID_CARTAO"=>$dados_lancamento['id_cartao'],
							":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
							":STATUS_LANCAMENTO"=>0
							));

		$array_id = array(
			"id_conta"=>$dados_lancamento['id_conta'],
			"id_cartao"=>$dados_lancamento['id_cartao'],
			"id_categoria"=>$dados_lancamento['id_categoria']
		);

		Carteira::atualizaSaldoConta($dados_lancamento, $array_id);
		Meta::analisaMeta($dados_lancamento, $array_id, $id_usuario);

	}


	#                                                  ╔═════════════════════════╗
	#									 	           ║     LANÇAMENTO FIXO     ║
	#                                                  ╚═════════════════════════╝

	//Corpo de criação de lançamento fixo;
	public static function iniciaLancamentoFixo($dados_lancamento, $id_usuario)
    {

        $result_verificacao = Visual::verificaVencimento($dados_lancamento['data_lancamento']);

        if($result_verificacao == "amanha")
        {
            Lancamento::criaLancamentoFixo($dados_lancamento, $id_usuario);
        }
        else
        {
            Lancamento::criaLancamentoUnico($dados_lancamento, $id_usuario);

            Lancamento::criaLancamentoFixoFuturo($dados_lancamento, $id_usuario);

            Visual::mostraMensagem('Lançamento criado com sucesso!', '/lancamento/historico');
            
        }

    }

    
	//Cria lançamento fixo normal, status_lancamento = 1;
    public static function criaLancamentoFixo($dados_lancamento, $id_usuario)
    {
        
        $sql = new Sql();

        $sql->execQuery("INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, status_lancamento)
                         VALUES (:DESCRICAO_LANCAMENTO, :TIPO_LANCAMENTO, :VALOR, :DATA_LANCAMENTO, :ID_USUARIO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :STATUS_LANCAMENTO)", array(
                            ":DESCRICAO_LANCAMENTO"=>$dados_lancamento['descricao_lancamento'],
                            ":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
                            ":VALOR"=>$dados_lancamento['valor'],
                            ":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
                            ":ID_USUARIO"=>$id_usuario,
                            ":ID_CONTA"=>$dados_lancamento['id_conta'],
                            ":ID_CARTAO"=>$dados_lancamento['id_cartao'],
                            ":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
                            ":STATUS_LANCAMENTO"=>1
                         ));

        Visual::mostraMensagem('Lançamento criado cmo sucesso!', '/lancamento/historico');

    }


	//Cria lançamento fixo futuro, status_lancamento = 1 (data + 1 mês);
    public static function criaLancamentoFixoFuturo($dados_lancamento, $id_usuario)
    {

        $sql = new Sql();

		$sql->execQuery("INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, status_lancamento)
						 VALUES (:DESCRICAO, :TIPO_LANCAMENTO, :VALOR, date_add(:DATA_LANCAMENTO, interval 1 month), :ID_USUARIO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :STATUS_LANCAMENTO)", array(
							":DESCRICAO"=>$dados_lancamento['descricao_lancamento'],
							":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
							":VALOR"=>$dados_lancamento['valor'],
							":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
							":ID_USUARIO"=>$id_usuario,
							":ID_CONTA"=>$dados_lancamento['id_conta'],
							":ID_CARTAO"=>$dados_lancamento['id_cartao'],
							":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
							":STATUS_LANCAMENTO"=>1
						 ));

    }


	#                                                  ╔══════════════════════════════╗
	#									 	           ║     LANÇAMENTO PARCELADO     ║
	#                                                  ╚══════════════════════════════╝

	//Corpo de criação de lançamento parcelado;
	public static function iniciaLancamentoParcelado($dados_lancamento, $id_usuario)
    {
        $dados_lancamento['valor'] = $dados_lancamento['valor'] / $dados_lancamento['parcela_total'];

        $result_verificacao = Visual::verificaVencimento($dados_lancamento['data_lancamento']);

        if($result_verificacao == "amanha")
        {

            $dados_lancamento['parcela_atual'] = 1;

            Lancamento::criaPrimeiraParcelaFutura($dados_lancamento, $id_usuario);

            Visual::mostraMensagem('Lançamento criado com sucesso!', '/lancamento/historico');

        }
        else
        {

            Lancamento::criaPrimeiraParcela($dados_lancamento, $id_usuario);

            Lancamento::criaSegundaParcela($dados_lancamento, $id_usuario);

            Visual::mostraMensagem('Lançamento criado com sucesso!', '/lancamento/historico');
            
        }


    }


	//Cria primeira parcela futura, status_lancamento = 3;
    public static function criaPrimeiraParcelaFutura($dados_lancamento, $id_usuario)
    {

        $sql = new Sql();

        $sql->execQuery("INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, parcela_total, parcela_atual, frequencia, status_lancamento)
                         VALUES (:DESCRICAO_LANCAMENTO, :TIPO_LANCAMENTO, :VALOR, :DATA_LANCAMENTO, :ID_USUARIO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :PARCELA_TOTAL, :PARCELA_ATUAL, :FREQUENCIA, :STATUS_LANCAMENTO)", array(
                            ":DESCRICAO_LANCAMENTO"=>$dados_lancamento['descricao_lancamento'],
                            ":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
                            ":VALOR"=>$dados_lancamento['valor'],
                            ":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
                            ":ID_USUARIO"=>$id_usuario,
                            ":ID_CONTA"=>$dados_lancamento['id_conta'],
                            ":ID_CARTAO"=>$dados_lancamento['id_cartao'],
                            ":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
                            ":PARCELA_ATUAL"=>$dados_lancamento['parcela_atual'],
                            ":PARCELA_TOTAL"=>$dados_lancamento['parcela_total'],
                            ":FREQUENCIA"=>$dados_lancamento['frequencia'],
                            ":STATUS_LANCAMENTO"=>3
                        ));

    }


	//Cria primeira parcela normal, status_lancamento = 0;
    public static function criaPrimeiraParcela($dados_lancamento, $id_usuario)
    {

        $sql = new Sql();

        $sql->execQuery("INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, parcela_total, parcela_atual, frequencia, status_lancamento)
                         VALUES (:DESCRICAO_LANCAMENTO, :TIPO_LANCAMENTO, :VALOR, :DATA_LANCAMENTO, :ID_USUARIO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :PARCELA_TOTAL, :PARCELA_ATUAL, :FREQUENCIA, :STATUS_LANCAMENTO)", array(
                            ":DESCRICAO_LANCAMENTO"=>$dados_lancamento['descricao_lancamento'],
                            ":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
                            ":VALOR"=>$dados_lancamento['valor'],
                            ":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
                            ":ID_USUARIO"=>$id_usuario,
                            ":ID_CONTA"=>$dados_lancamento['id_conta'],
                            ":ID_CARTAO"=>$dados_lancamento['id_cartao'],
                            ":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
                            ":PARCELA_ATUAL"=>1,
                            ":PARCELA_TOTAL"=>$dados_lancamento['parcela_total'],
                            ":FREQUENCIA"=>$dados_lancamento['frequencia'],
                            ":STATUS_LANCAMENTO"=>0
                        ));

        $array_id = array(
            "id_conta"=>$dados_lancamento['id_conta'],
            "id_cartao"=>$dados_lancamento['id_cartao'],
            "id_categoria"=>$dados_lancamento['id_categoria']
        );

        Carteira::atualizaSaldoConta($dados_lancamento, $array_id);
        Meta::analisaMeta($dados_lancamento, $array_id, $id_usuario);

    }


	//Cria segunda parcela futura, status_lancamento = 3;
    public static function criaSegundaParcela($dados_lancamento, $id_usuario)
    {

        $dados_lancamento['parcela_atual'] = 2;
        $dados_lancamento['status_lancamento'] = 3;

        $frequencia = Lancamento::analisaFrequencia($dados_lancamento);

        if($frequencia['frequencia'] == "dias")
        {
            Lancamento::criaParcelaFuturaDias($dados_lancamento, $id_usuario, $frequencia);
        }
        else
        {
            Lancamento::criaParcelaFuturaMeses($dados_lancamento, $id_usuario, $frequencia);
        }


    }


	//Analisa frequência em dias ou meses;
    public static function analisaFrequencia($dados_lancamento)
    {

        $sql = new Sql();

        if($dados_lancamento['frequencia'] <= 2)
        {

            $results = $sql->select("SELECT dias FROM frequencia WHERE id_frequencia = :ID_FREQUENCIA", array(
                ":ID_FREQUENCIA"=>$dados_lancamento['frequencia']
            ));

            $results[0]['frequencia'] = "dias";

            return $results[0];

        }
        else
        {

            $results = $sql->select("SELECT mes FROM frequencia WHERE id_frequencia = :ID_FREQUENCIA", array(
                ":ID_FREQUENCIA"=>$dados_lancamento['frequencia']
            ));

            $results[0]['frequencia'] = "meses";

            return $results[0];

        }


    }
    

	//Cria parcela somando intervalo de dias;
    public static function criaParcelaFuturaDias($dados_lancamento, $id_usuario, $frequencia)
    {
        
        $sql = new Sql();

        $sql->execQuery("CALL sp_lancamento_parcelado_dias(:ID_USUARIO, :TIPO_LANCAMENTO, :DESCRICAO_LANCAMENTO, :VALOR, :PARCELA_ATUAL, :PARCELA_TOTAL, :DATA_LANCAMENTO, :FREQUENCIA, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :STATUS_LANCAMENTO, :INTERVALO)", array(
            ":ID_USUARIO"=>$id_usuario,
            ":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
            ":DESCRICAO_LANCAMENTO"=>$dados_lancamento['descricao_lancamento'],
            ":VALOR"=>$dados_lancamento['valor'],
            ":PARCELA_ATUAL"=>$dados_lancamento['parcela_atual'],
            ":PARCELA_TOTAL"=>$dados_lancamento['parcela_total'],
            ":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
            ":FREQUENCIA"=>$dados_lancamento['frequencia'],
            ":ID_CONTA"=>$dados_lancamento['id_conta'],
            ":ID_CARTAO"=>$dados_lancamento['id_cartao'],
            ":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
            ":STATUS_LANCAMENTO"=>$dados_lancamento['status_lancamento'],
            ":INTERVALO"=>$frequencia['dias']
            ));

    }


	//Cria parcela somando intervalo de meses;
    public static function criaParcelaFuturaMeses($dados_lancamento, $id_usuario, $frequencia)
    {
        
        $sql = new Sql();

        $sql->execQuery("CALL sp_lancamento_parcelado_meses(:ID_USUARIO, :TIPO_LANCAMENTO, :DESCRICAO_LANCAMENTO, :VALOR, :PARCELA_ATUAL, :PARCELA_TOTAL, :DATA_LANCAMENTO, :FREQUENCIA, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :STATUS_LANCAMENTO, :INTERVALO)", array(
            ":ID_USUARIO"=>$id_usuario,
            ":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
            ":DESCRICAO_LANCAMENTO"=>$dados_lancamento['descricao_lancamento'],
            ":VALOR"=>$dados_lancamento['valor'],
            ":PARCELA_ATUAL"=>$dados_lancamento['parcela_atual'],
            ":PARCELA_TOTAL"=>$dados_lancamento['parcela_total'],
            ":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
            ":FREQUENCIA"=>$dados_lancamento['frequencia'],
            ":ID_CONTA"=>$dados_lancamento['id_conta'],
            ":ID_CARTAO"=>$dados_lancamento['id_cartao'],
            ":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
            ":STATUS_LANCAMENTO"=>$dados_lancamento['status_lancamento'],
            ":INTERVALO"=>$frequencia['mes']
            ));


    }


	#                                                  ╔═══════════════════════════╗
	#									 	           ║     VERIFICAÇÃO GERAL     ║
	#                                                  ╚═══════════════════════════╝

	//Atualiza status do lançamento analisado para 0;
	public static function atualizaStatusLancamento($dados_lancamento, $id_usuario)
    {

        $sql = new Sql();

        $sql->execQuery("UPDATE lancamento SET status_lancamento = 0 WHERE id_lancamento = :ID_LANCAMENTO", array(
            ":ID_LANCAMENTO"=>$dados_lancamento['id_lancamento']
        ));

        $array_id = array(
            "id_conta"=>$dados_lancamento['id_conta'],
            "id_cartao"=>$dados_lancamento['id_cartao'],
            "id_categoria"=>$dados_lancamento['id_categoria']
        );

        Carteira::atualizaSaldoConta($dados_lancamento, $array_id);
        Meta::analisaMeta($dados_lancamento, $array_id, $id_usuario);

    }


	#                                                  ╔══════════════════════════════════════╗
	#									 	           ║     VERIFICAÇÃO LANÇAMENTO ÚNICO     ║
	#                                                  ╚══════════════════════════════════════╝

	//Verificação de lançamentos únicos futuros;
	public static function verificaLancamentoUnicoFuturo($id_usuario)
	{

		$sql = new Sql();

		$lancamentos = $sql->select("SELECT * FROM lancamento WHERE data_lancamento <= current_date() AND status_lancamento = 2 AND id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));

		foreach($lancamentos as $key => $value)
		{
			Lancamento::atualizaStatusLancamento($lancamentos[$key], $id_usuario);
		}

	}
	

	#                                                  ╔═════════════════════════════════════╗
	#									 	           ║     VERIFICAÇÃO LANÇAMENTO FIXO     ║
	#                                                  ╚═════════════════════════════════════╝

	//Verificação de lançamentos fixos;
	public static function verificaLancamentoFixo($id_usuario)
	{

		$sql = new Sql();

		$lancamentos = $sql->select("SELECT * FROM lancamento WHERE data_lancamento <= current_date() AND status_lancamento = 1 AND id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));

		foreach($lancamentos as $key => $value)
		{
			Lancamento::criaLancamentoFixoFuturo($lancamentos[$key], $id_usuario);

			Lancamento::atualizaStatusLancamento($lancamentos[$key], $id_usuario);
		}

	}


    #                                                  ╔══════════════════════════════════════════╗
	#									 	           ║     VERIFICAÇÃO LANÇAMENTO PARCELADO     ║
	#                                                  ╚══════════════════════════════════════════╝

	//Verificação de lançamentos parcelados futuros;
	public static function verificaLancamentoParceladoFuturo($id_usuario)
	{

		$sql = new Sql();

		$lancamentos = $sql->select("SELECT * FROM lancamento WHERE data_lancamento <= current_date() AND status_lancamento = 3 AND id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));

		foreach($lancamentos as $key => $value)
		{
			Lancamento::criaLancamentoParceladoFuturo($lancamentos[$key], $id_usuario);

			Lancamento::atualizaStatusLancamento($lancamentos[$key], $id_usuario);
		}

	}


	//Cria proxima parcela futura;
	public static function criaLancamentoParceladoFuturo($dados_lancamento, $id_usuario)
	{
		if($dados_lancamento['parcela_atual'] != $dados_lancamento['parcela_total'])
		{

			$dados_lancamento['parcela_atual'] = $dados_lancamento['parcela_atual'] + 1;

			$frequencia = Lancamento::analisaFrequencia($dados_lancamento);

			$dados_lancamento['status_lancamento'] = 3;
			
			if($frequencia['frequencia'] == "dias")
			{
				Lancamento::criaParcelaFuturaDias($dados_lancamento, $id_usuario, $frequencia);
			}
			else
			{
				Lancamento::criaParcelaFuturaMeses($dados_lancamento, $id_usuario, $frequencia);
			}

		}
	}


	#                                                  ╔═════════════════════════════╗
	#									 	           ║     FUNÇÕES DE LISTAGEM     ║
	#                                                  ╚═════════════════════════════╝

	//Lista todos lançamentos para o histórico de lançamentos;
    public static function listaLancamentos($id_usuario)
    {
        $sql = new Sql();

        $results = $sql->select("SELECT lancamento.descricao_lancamento, lancamento.tipo_lancamento, lancamento.valor, categoria.descricao, lancamento.data_lancamento, IF(conta.apelido <> NULL, NULL, conta.apelido) 'conta', cartao.apelido 'cartao', lancamento.parcela_total, lancamento.parcela_atual, lancamento.frequencia
        FROM lancamento															
        INNER JOIN categoria ON lancamento.id_categoria = categoria.id_categoria AND lancamento.id_usuario = :ID_USUARIO AND status_lancamento = 0
        LEFT OUTER JOIN cartao ON lancamento.id_cartao = cartao.id_cartao
        LEFT OUTER JOIN conta ON lancamento.id_conta = conta.id_conta ORDER BY id_lancamento ASC" ,
        array(
            ":ID_USUARIO"=>$id_usuario
        ));

		foreach($results as $key => $value)
		{
			$data = date("d/m/Y", strtotime($results[$key]["data_lancamento"]));
			$results[$key]["data_lancamento"] = $data;
		}

		return $results;
    }


	//Lista categorias para o select do front;
	public static function listaCategoria()
	{

		$sql = new Sql();

		return $sql->select("SELECT descricao, id_categoria FROM categoria ORDER BY descricao ASC");

	}


	//Lista categorias de despesa para o select do front;
	public static function listaCategoriaDespesa()
	{
		$sql = new Sql();

		return $sql->select("SELECT id_categoria, descricao FROM categoria WHERE id_categoria > 4 ORDER BY id_categoria ASC");
		
	}


	//Lista tipos de frequencia para o select do front;
	public static function listaFrequencia()
	{

		$sql = new Sql();

		return $sql->select("SELECT descricao, id_frequencia FROM frequencia");

	}









}
?>