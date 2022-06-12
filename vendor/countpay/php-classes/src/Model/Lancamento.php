<?php 
namespace Countpay\Model;

use \Countpay\DB\Sql;
use \Countpay\Model;


class Lancamento extends Model{	

    /*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	     FUNÇÕES LANCAMENTO                                                  ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//=============================================== Lançamento Unico normal ===============================================//
	public static function criaLancamentoUnico($dados_lancamento, $array_id, $id_usuario)
	{

		$sql = new Sql();

		return $sql->select("CALL sp_lancamento_normal(:ID_USUARIO, :DESCRICAO, :VALOR, :TIPO_LANCAMENTO, :DATA_LANCAMENTO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA)", array(
			':ID_USUARIO'=>$id_usuario,
			':DESCRICAO'=>$dados_lancamento['descricao'],
			':VALOR'=>$dados_lancamento['valor'],
			':TIPO_LANCAMENTO'=>$dados_lancamento['tipo_lancamento'],			
			':DATA_LANCAMENTO'=>$dados_lancamento['data_lancamento'],			
			':ID_CONTA'=>$array_id['id_conta'],
			':ID_CARTAO'=>$array_id['id_cartao'],
			':ID_CATEGORIA'=>$array_id['id_categoria']
		));

	}


	//================================== verifica a necessidade de lançar lancamentos pendentes =============================//
	public static function verificaLancamentoFixo($id_usuario)
	{

		$sql = new Sql();
		
		$results = $sql->select("SELECT * FROM lancamento WHERE data_lancamento < current_date() AND fixo = 1");

		if(isset($results))
		{
			Lancamento::lancaLancamentoFixo($results);
		}

	}


	//============================================= Percorre os lancamentos pendentes =======================================//
	public static function lancaLancamentoFixo($lancamentos)
	{

		foreach($lancamentos as $key => $value)
		{
			Lancamento::criaLancamentoFuturo($lancamentos[$key]);

			Lancamento::modificaFixoLancamento($lancamentos[$key]);
		}

	}


	public static function criaLancamentoFuturo($dados_lancamento)
	{

		$sql = new Sql();

		$sql->execQuery("INSERT INTO lancamento (descricao_lancamento, tipo_lancamento, valor, data_lancamento, id_usuario, id_conta, id_cartao, id_categoria, fixo)
						 VALUES (:DESCRICAO, :TIPO_LANCAMENTO, :VALOR, date_add(:DATA_LANCAMENTO, interval 1 month), :ID_USUARIO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA, :FIXO)", array(
							":DESCRICAO"=>$dados_lancamento['descricao_lancamento'],
							":TIPO_LANCAMENTO"=>$dados_lancamento['tipo_lancamento'],
							":VALOR"=>$dados_lancamento['valor'],
							":DATA_LANCAMENTO"=>$dados_lancamento['data_lancamento'],
							":ID_USUARIO"=>$dados_lancamento['id_usuario'],
							":ID_CONTA"=>$dados_lancamento['id_conta'],
							":ID_CARTAO"=>$dados_lancamento['id_cartao'],
							":ID_CATEGORIA"=>$dados_lancamento['id_categoria'],
							":FIXO"=>$dados_lancamento['fixo']
						 ));

	}


	public static function modificaFixoLancamento($dados_lancamento)
	{

		$sql = new Sql();

		$sql->execQuery("UPDATE lancamento SET fixo = 0 WHERE id_lancamento = :ID_LANCAMENTO", array(
			":ID_LANCAMENTO"=>$dados_lancamento['id_lancamento']
		));

	}

    /*===========================================================|===========================================================\\
	||											    																		 ||
	||										          FUNÇÕES TRANSFERÊNCIA                                                  ||
	||												    																	 ||
	//===========================================================|===========================================================*/


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	    FUNÇÕES DE LISTAGEM                                                  ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//============================================= Lista todos os lançamentos ==============================================//
    public static function listaLancamentos($id_usuario)
    {
        $sql = new Sql();

        // Select dos dados usado para gerar o histórico de lançamento
        return $sql->select("SELECT lancamento.descricao_lancamento, lancamento.tipo_lancamento, lancamento.valor, categoria.descricao, lancamento.data_lancamento, IF(conta.apelido <> NULL, NULL, conta.apelido) 'conta', cartao.apelido 'cartao', lancamento.quantidade_parcelas, lancamento.frequencia
        FROM lancamento															
        INNER JOIN categoria ON lancamento.id_categoria = categoria.id_categoria AND lancamento.id_usuario = :ID_USUARIO
        LEFT OUTER JOIN cartao ON lancamento.id_cartao = cartao.id_cartao
        LEFT OUTER JOIN conta ON lancamento.id_conta = conta.id_conta ORDER BY id_lancamento ASC" ,
        array(
            ":ID_USUARIO"=>$id_usuario
        ));
    
    }


	//============================================== Lista todas as categorias ==============================================//
	public static function listaCategoria()				//Talvez esteja errado
	{

		$sql = new Sql();

		return $sql->select("SELECT descricao FROM categoria ORDER BY descricao ASC");


	}


	//============================================== Lista todas as categorias ==============================================//
	public static function listaCategoriaDespesa()
	{
		$sql = new Sql();

		return $sql->select("SELECT descricao FROM categoria WHERE id_categoria > 4 ORDER BY id_categoria ASC");
		
	}


	//============================================= Lista todas as frequencias ==============================================//
	public static function listaFrequencia()
	{

		$sql = new Sql();

		return $sql->select("SELECT descricao FROM frequencia");

	}


	//================================================ Lista tipos de receita ===============================================//
	public static function listaTipoReceita()
	{

		$sql = new Sql();

		return $sql->select("SELECT descricao FROM tipo_receita WHERE id_tipo_receita < 3");

	}


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	      FUNÇÕES DE BUSCA                                                   ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//============================================= string -> ID | Categoria ==============================================//
	public static function buscaCategoria($apelidoCategoria)
	{

		$sql = new Sql();

		$id_categoria =  $sql->select("SELECT id_categoria FROM categoria WHERE descricao = :DESCRICAO", array (
		":DESCRICAO"=>$apelidoCategoria
		));

		if (!empty($id_categoria)){
			return $id_categoria[0]['id_categoria'];
		} else {
			return NULL;
		}

	}



	/*===========================================================|===========================================================\\
	||											    																		 ||
	||											    	  SEÇÃO DE FUNÇÕES												     ||
	||											    			DE															 ||
	||										    	    LANÇAMENTO PARCELADO                         						 ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//============================================= CORPO DO LANÇAMENTO PARCELADO ===========================================//
	public static function lancamentoParcelado($dados_lancamento, $id_usuario, $array_id, $quant)
	{
		$frequencia = $dados_lancamento['frequencia'];
		$parcela = $dados_lancamento['parcela'];

		// Esquema de looping para a quantidade de parcelas
        // Contador que soma de 1 em 1 até ser menor que $parcela
        for ($i=1; $i < $parcela+1; $i++) {

            $id_lancamento = Lancamento::criaParcela($dados_lancamento, $array_id, $i);

            // quant recebe a quantidade de dias ou mês (depende da seleção do usuário) multiplicada pelo contador
            $tempoDaParcela = $quant * ($i-1);

            // Verificação para saber como é necessário inserir as tabelas (dia ou mês)
            // (Motivo: "INTERVAL X MONTH/DAY")
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

		// Analisa se a frequência é dias ou mês
		if ($frequencia == 'Semanalmente' || $frequencia == 'Quinzenalmente')
		{

			// Select para coleta a quantidade de [dias] selecionado pelo usuário
			$quantidade = $sql->select("SELECT dias FROM frequencia WHERE descricao = :FREQUENCIA", array(
				':FREQUENCIA'=>$frequencia
			));

			// A variável quantAux serve para receber o dado do array de cima e converter a mesma para string
			return $quantidade[0]['dias'];

		} else {
		// So executa caso o usuário selecione as opções de mês em diante 

			// Select para coleta a quantidade de [meses] selecionado pelo usuário
			$quantidade = $sql->select("SELECT mes FROM frequencia WHERE descricao = :FREQUENCIA", array(
				':FREQUENCIA'=>$frequencia
			));

			// A variável quantAux serve para receber o dado do array de cima e converter a mesma para string
			return $quantidade[0]['mes'];

		}

	}


	//==================================================== CRIA PARCELA =====================================================//
	//cria parcela x, com data igual a todas e colocação propria.
	public static function criaParcela($dados_lancamento, $array_id, $i)
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_lancamento_parcelado(:ID_USUARIO, :TIPO_LANCAMENTO, :DESCRICAO, :VALOR, :PARCELA, :DATA_LANCAMENTO, :FREQUENCIA, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA)", array(
			':ID_USUARIO' => $array_id['id_usuario'],
			':TIPO_LANCAMENTO' => $dados_lancamento['tipo_lancamento'],
			':DESCRICAO' => $dados_lancamento['descricao'],
			':VALOR' => $dados_lancamento['valor'],
			':PARCELA' => $i.' / '.$dados_lancamento['parcela'],
			':DATA_LANCAMENTO' => $dados_lancamento['data_lancamento'],
			':FREQUENCIA' => $dados_lancamento['frequencia'],
			':ID_CONTA' => $array_id['id_conta'],
			':ID_CARTAO' => $array_id['id_cartao'],
			':ID_CATEGORIA' => $array_id['id_categoria']
		));

		return $results[0]['id_lancamento'];

	}


	//=========================================== Altera a parcela com sua data real ========================================//

	//========================================================= DIAS ========================================================//
	public static function alteraParcelaDia($id_lancamento, $dias)
	{

		$sql = new Sql();

		// Inserção da parcela com a soma de semana ou quinzena no campo (data_lancamento)
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

		// Inserção da parcela com a soma de meses no campo (data_lancamento)
		$sql->execQuery("UPDATE lancamento SET data_lancamento = date_add(data_lancamento, INTERVAL :DIAS MONTH)
		WHERE id_lancamento = :ID_LANCAMENTO;", array(
			':ID_LANCAMENTO'=> $id_lancamento,
			':DIAS'=> $meses
		));

	}


	//




}
?>