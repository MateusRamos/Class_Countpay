<?php 
namespace Countpay\Model;

use \Countpay\DB\Sql;


class Meta {	

	#                                                  ╔══════════════════════╗
	#									 	           ║     MINHAS METAS     ║
	#                                                  ╚══════════════════════╝

    //Lista todas as metas ativas do usuario;
    public static function listaMetas($id_usuario)
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM meta WHERE id_usuario = :ID_USUARIO", array(
            ":ID_USUARIO" => $id_usuario
        ));

    }


	#                                                  ╔═══════════════════════╗
	#									 	           ║  GUARDANDO UMA GRANA  ║
	#                                                  ╚═══════════════════════╝

	//Insere uma nova meta com os dados do front;
    public static function criaGuardando($dados_meta, $id_usuario)
    {

        $sql = new Sql();

        $verificacao = Meta::verificaMetaAtiva($dados_meta['id_conta']);

        if($verificacao == 0)
        {
            $status = "pausado";
        } 
        else 
        {
            $status = "ativo";
        }

        if(isset($dados_meta['valor_atual']) )
        {
            $results = $sql->select("SELECT saldo FROM conta WHERE id_conta = :ID_CONTA", array(
                ":ID_CONTA"=>$dados_meta['id_conta']
            ));

            $valor_atual = $results[0]['saldo'];
        }
        else
        {
            $valor_atual = NULL;
        }


        $sql->execQuery("INSERT INTO meta (nome, objetivo, valor, valor_atual, data_inicial, data_final, status, id_conta, id_usuario, tipo_meta) 
                         VALUES (:NOME, :OBJETIVO, :VALOR, :VALOR_ATUAL, :DATA_INICIAL, :DATA_FINAL, :STATUS, :ID_CONTA, :ID_USUARIO,:TIPO_META)", array(
                            ":NOME"=>$dados_meta['nome'],
                            ":OBJETIVO"=>$dados_meta['objetivo'],
                            ":VALOR"=>$dados_meta['valor'],
                            ":VALOR_ATUAL"=>$valor_atual,
                            ":DATA_INICIAL"=>$dados_meta['data_inicial'],
                            ":DATA_FINAL"=>$dados_meta['data_final'],
                            ":STATUS"=> $status,
                            ":ID_CONTA"=>$dados_meta['id_conta'],
                            ":ID_USUARIO"=>$id_usuario,
                            ":TIPO_META"=>"guardando"
                         ));

    }


    //Verifica se o usuário tem alguma meta ativa;
    public static function verificaMetaAtiva($id_conta)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT id_meta FROM meta WHERE status = 'ativo' AND id_conta = :ID_CONTA", array(
            ":ID_CONTA" => $id_conta
        ));

        if(count($results) > 0){
            return 0;
        } 
        else
        {
            return 1;
        }

    }


    //Analisa se a meta ativa foi concluida;
    public static function analisaMeta($dados_lancamento)
    {

        $tipo_lancamento = substr($dados_lancamento['tipo_lancamento'], 0, 7);

        if($tipo_lancamento == "Receita" && isset($dados_lancamento['id_conta']))
        {

            $verificacao = Meta::verificaMetaAtiva($dados_lancamento['id_conta']);

            if($verificacao == 0)
            {
                Meta::analisaMeta2($dados_lancamento);
            }
            else
            {
                Meta::ativaProximaMeta($dados_lancamento['id_conta']);
            }

        }
        else if($tipo_lancamento == "Despesa" && isset($dados_lancamento['id_conta']))
        {
            $verificacao = Meta::verificaMetaAtiva($dados_lancamento['id_conta']);

            if($verificacao == 0)
            {
                Meta::subtraiValorAtual($dados_lancamento);
            }
            else
            {
                Meta::ativaProximaMeta($dados_lancamento['id_conta']);
            }
        }

    }


    //Função de sequencia da função analisaMeta;
    public static function analisaMeta2($dados_lancamento)
    {

        $sql = new Sql();

        $resultado = $sql->select("SELECT meta.id_meta, meta.valor, meta.valor_atual, conta.saldo FROM meta 
                                   INNER JOIN conta ON meta.id_conta = conta.id_conta 
                                   AND status = 'ativo' AND meta.id_conta = :ID_CONTA AND tipo_meta = 'guardando'", array(
                                     ":ID_CONTA" => $dados_lancamento['id_conta']
                                   ));

        $saldo_liguido = $resultado[0]['saldo'] - $resultado[0]['valor_atual'];
        
        if($saldo_liguido >= $resultado[0]['valor'])
        {

            $sql->execQuery("UPDATE meta SET status = 'concluido' WHERE id_meta = :ID_META", array(
                ":ID_META" => $resultado[0]['id_meta']
            ));

            Meta::ativaProximaMeta($dados_lancamento['id_conta']);

        }

    }


    //Ativa meta pausada, caso haja necessidade;
    public static function ativaProximaMeta($id_conta)
    {

        $sql = new Sql();

        $valor_atual = $sql->select("SELECT saldo FROM conta WHERE id_conta = :ID_CONTA", array(
            ":ID_CONTA"=>$id_conta
        ));

        $sql->execQuery("UPDATE meta SET status = 'ativo' AND valor_atual = :VALOR_ATUAL
                         WHERE status = 'pausado' AND data_inicial = (SELECT data_inicial FROM meta 
                        WHERE status = 'pausado' AND id_conta = :ID_CONTA ORDER BY data_inicial ASC limit 1) AND id_conta = :ID_CONTA AND tipo_meta = 'guardando'", array(
                            ":ID_CONTA" => $id_conta,
                            ":VALOR_ATUAL"=> $valor_atual[0]['saldo']
                        ));

    }


    public static function BuscaDadosMeta($id_meta)
    {

        $sql = new Sql();
                
        return  $sql->select("SELECT meta.*, conta.apelido 
                             FROM meta 
                             INNER JOIN conta ON meta.id_conta = conta.id_conta AND id_meta = :ID_META", array(
            ":ID_META"=>$id_meta
        ));

    }


    public static function subtraiValorAtual($dados_lancamento)
    {

        $sql = new Sql();

        $dados_meta = $sql->select("SELECT id_meta, valor_atual FROM meta WHERE status = 'ativo' AND id_conta = :ID_CONTA AND tipo_meta = 'guardando'", array(
            ":ID_CONTA"=>$dados_lancamento['id_conta']
        ));
        
        if(($dados_meta[0]['valor_atual'] - $dados_lancamento['valor']) < 0)
        {
            $valor_atual = NULL;
        }
        else
        {
            $valor_atual = $dados_meta[0]['valor_atual'] - $dados_lancamento['valor'];
        }


        $sql->execQuery("UPDATE meta SET valor_atual = :VALOR_ATUAL WHERE id_meta = :ID_META", array(
            ":VALOR_ATUAL"=>$valor_atual,
            ":ID_META"=>$dados_meta[0]['id_meta']
        ));

    }


    public static function alteraGuardandoUmaGrana($dados_meta)
    {

        $sql = new Sql();

        if(isset($dados_meta['valo_atual']))
        {
            $valor_atual = $sql->select("SELECT saldo FROM conta WHERE id_conta = :ID_CONTA", array(
                ":ID_CONTA"=>$dados_meta['id_conta']
            ));
        }
        else
        {
            $valor_atual = NULL;
        }


        $sql->execQuery("UPDATE meta SET nome = :NOME, objetivo = :OBJETIVO, valor = :VALOR_ATUAL, data_inicial = :DATA_INICIAL, data_final = :DATA_FINAL WHERE id_meta = :ID_META", array(
            ":NOME"=>$dados_meta['nome'],
            ":OBJETIVO"=>$dados_meta['objetivo'],
            ":VALOR_ATUAL"=>$dados_meta['valor'],
            ":DATA_INICIAL"=>$dados_meta['data_inicial'],
            ":DATA_FINAL"=>$dados_meta['data_final'],
            ":ID_META"=>$dados_meta['id_meta']
        ));

    }


    //Verifica se a meta deletado pertence mesmo ao usuário;
	public static function verificaPosseMeta($id_usuario, $id_meta)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM meta WHERE id_usuario = :ID_USUARIO AND id_meta = :ID_META", array(
			"ID_USUARIO"=>$id_usuario,
			":ID_META"=>$id_meta
		));

		
		if(count($results) > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}

	}


    //Deleta cartão pelo id_meta;
	public static function deletaMeta($id_meta)
	{

		$sql = new Sql();

		$sql->execQuery("DELETE FROM meta WHERE id_meta = :ID_META", array(
			':ID_META'=>$id_meta
		));
	
	}
    

    public static function verificaSeMetaEstaAtiva($id_meta)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT status FROM meta WHERE id_meta = :ID_META", array(
            ":ID_META"=>$id_meta
        ));

        return $results[0]['status'];

    }


    public static function pausaMeta($id_meta)
    {

        $sql = new Sql();

        $results = $sql->execQuery("UPDATE meta SET status = 'pausado' WHERE id_meta = :ID_META", array(
            ":ID_META"=>$id_meta
        ));

    }


    public static function buscaIdContaDaMeta($id_meta)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT id_conta FROM meta WHERE id_meta = :ID_META", array(
            ":ID_META"=>$id_meta
        ));

        return $results[0]['id_conta'];

    }


    public static function pausaMetaAtiva($id_conta)
    {

        $sql = new Sql();

        $sql->execQuery("UPDATE meta SET status = 'pausado' WHERE id_conta = :ID_CONTA AND status = 'ativo'", array(
            ":ID_CONTA"=>$id_conta
        ));

    }
    

    public static function ativaMeta($id_meta)
    {

        $sql = new Sql();

        $sql->execQuery("UPDATE meta SET status = 'ativo' WHERE id_meta = :ID_META", array(
            ":ID_META"=>$id_meta
        ));

    }



}
?>