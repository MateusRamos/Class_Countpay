<?php 
namespace Countpay\Model;

use \Countpay\DB\Sql;
use Countpay\Model;

class Lancamento extends Model {	

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

   	//============================================= CORPO DO LANÇAMENTO PARCELADO ===========================================//
	public static function lancamentoParcelado($dados_lancamento, $id_usuario, $quant)
	{
		$frequencia = $dados_lancamento['frequencia'];
		$parcela = $dados_lancamento['parcela_total'];

        for ($i=1; $i < $parcela+1; $i++) {

            $id_lancamento = Lancamento::criaParcela($dados_lancamento, $i, $id_usuario);

            $tempoDaParcela = $quant * ($i-1);

            if ($frequencia == 'Semanalmente' || $frequencia == 'Quinzenalmente')
            {
                Lancamento::alteraParcelaDia($id_lancamento, $tempoDaParcela);

            } else {
                Lancamento::alteraParcelaMes($id_lancamento, $tempoDaParcela);

            }
        }

	}

	
	//============================================ ANALISA FREQUENCIA PARA DIA/MES ==========================================//
	public static function analisaFrequencia($dados_lancamento)
	{

		$sql = new Sql();
		$frequencia = $dados_lancamento['frequencia'];

		if ($frequencia == 'Semanalmente' || $frequencia == 'Quinzenalmente')
		{

			$quantidade = $sql->select("SELECT dias FROM frequencia WHERE descricao = :FREQUENCIA", array(
				':FREQUENCIA'=>$frequencia
			));

			return $quantidade[0]['dias'];

		} else {

			$quantidade = $sql->select("SELECT mes FROM frequencia WHERE descricao = :FREQUENCIA", array(
				':FREQUENCIA'=>$frequencia
			));

			return $quantidade[0]['mes'];

		}

	}


	//==================================================== CRIA PARCELA =====================================================//
	//cria parcela x, com data igual a todas e colocação propria.
	public static function criaParcela($dados_lancamento, $i, $id_usuario)
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_lancamento_parcelado(:ID_USUARIO, :TIPO_LANCAMENTO, :DESCRICAO, :VALOR, :PARCELA, :PARCELA_ATUAL, :DATA_LANCAMENTO, :FREQUENCIA, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :STATUS)", array(
			':ID_USUARIO' => $id_usuario,
			':TIPO_LANCAMENTO' => $dados_lancamento['tipo_lancamento'],
			':DESCRICAO' => $dados_lancamento['descricao_lancamento'],
			':VALOR' => $dados_lancamento['valor'],
			':PARCELA' =>$dados_lancamento['parcela_total'],
            ':PARCELA_ATUAL'=>$i,
			':DATA_LANCAMENTO' => $dados_lancamento['data_lancamento'],
			':FREQUENCIA' => $dados_lancamento['frequencia'],
			':ID_CONTA' => $dados_lancamento['id_conta'],
			':ID_CARTAO' => $dados_lancamento['id_cartao'],
			':ID_CATEGORIA' => $dados_lancamento['id_categoria'],
            ':STATUS' => 2
		));

		return $results[0]['id_lancamento'];

	}


	//=========================================== Altera a parcela com sua data real ========================================//

	//========================================================= DIAS ========================================================//
	public static function alteraParcelaDia($id_lancamento, $dias)
	{

		$sql = new Sql();

		$sql->execQuery("UPDATE lancamento SET data_lancamento = date_add(data_lancamento, INTERVAL :DIAS DAY)
		WHERE id_lancamento = :ID_LANCAMENTO;", array(
			':ID_LANCAMENTO'=> $id_lancamento,
			':DIAS'=> $dias
		));

	}


	//========================================================= MESES ========================================================//
	public static function alteraParcelaMes($id_lancamento, $meses)
	{

		$sql = new Sql();

		$sql->execQuery("UPDATE lancamento SET data_lancamento = date_add(data_lancamento, INTERVAL :DIAS MONTH)
		WHERE id_lancamento = :ID_LANCAMENTO;", array(
			':ID_LANCAMENTO'=> $id_lancamento,
			':DIAS'=> $meses
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

        Carteira::atualizaSaldoConta($dados_lancamento);
        Meta::analisaMeta($dados_lancamento, $id_usuario);

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



	#                                                  ╔═════════════════════════════╗
	#									 	           ║  FUNÇÕES DE TRANSFERÊNCIA   ║
	#                                                  ╚═════════════════════════════╝

	//==================================================== TRANSFERÊNCIA =====================================================//
	public static function lancamentoTransferencia($dados_lancamento, $id_usuario)
	{

		$sql = new Sql();

		$sql->select("CALL sp_lancamento_transferencia(:DESCRICAO, :TIPO_LANCAMENTO, :VALOR, :DATA_LANCAMENTO, :ID_USUARIO, :ID_CONTA, :ID_CATEGORIA)", array(
			':DESCRICAO' => 'Transferência para'. $dados_lancamento['id_conta_despesa'],
			':TIPO_LANCAMENTO' => 'Transferência',
			':VALOR' => $dados_lancamento['valor'],
			':DATA_LANCAMENTO' => $dados_lancamento['data_lancamento'],
			':ID_USUARIO' =>$id_usuario,
            ':ID_CONTA'=> $dados_lancamento['id_conta_despesa'],
			':ID_CATEGORIA'=> 'Transferência',
		));

		$sql->select("CALL sp_lancamento_transferencia(:DESCRICAO, :TIPO_LANCAMENTO, :VALOR, :DATA_LANCAMENTO, :ID_USUARIO, :ID_CONTA, :ID_CATEGORIA)", array(
			':DESCRICAO' => 'Transferência recebida de'. $dados_lancamento['id_conta_receita'],
			':TIPO_LANCAMENTO' => 'Transferência',
			':VALOR' => $dados_lancamento['valor'],
			':DATA_LANCAMENTO' => $dados_lancamento['data_lancamento'],
			':ID_USUARIO' =>$id_usuario,
            ':ID_CONTA'=> $dados_lancamento['id_conta_receita'],
			':ID_CATEGORIA'=> 'Transferência',
		));


	}





}
?>