<?php 
namespace Countpay\Model;

use \Countpay\Model;
use \Countpay\DB\Sql;


class Meta extends Model{	

    /*===========================================================|===========================================================\\
	||											    																		 ||
	||										        FUNÇÕES GUARDANDO UMA GRANA                                              ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//============================================= CRIA - GUARDANDO UMA GRANA ==============================================//
    public static function criaGuardando($dados_meta, $id_usuario, $id_conta)
    {

        $sql = new Sql();

        $verificacao = Meta::verificaMetaAtiva($id_conta);

        if($verificacao == 0)
        {
            $status = "pausado";
        } else 
        {
            $status = "ativo";
        }

        $sql->execQuery("INSERT INTO meta (nome, objetivo, valor, data_inicial, data_final, status, id_conta, id_usuario) 
                         VALUES (:NOME, :OBJETIVO, :VALOR, :DATA_INICIAL, :DATA_FINAL, :STATUS, :ID_CONTA, :ID_USUARIO)", array(
                            ":NOME"=>$dados_meta['nome'],
                            ":OBJETIVO"=>$dados_meta['objetivo'],
                            ":VALOR"=>$dados_meta['valor'],
                            ":DATA_INICIAL"=>$dados_meta['data_inicial'],
                            ":DATA_FINAL"=>$dados_meta['data_final'],
                            ":STATUS"=> $status,
                            ":ID_CONTA"=>$id_conta,
                            ":ID_USUARIO"=>$id_usuario
                         ));

    }


    //===========================================
    public static function analisaMeta($dados_lancamento, $array_id, $id_usuario)
    {

        $sql = new Sql();

        $tipo_lancamento = substr($dados_lancamento['tipo_lancamento'], 0, 7);

        if($tipo_lancamento == "Receita" && isset($array_id['id_conta']))
        {

            $verificacao = Meta::verificaMetaAtiva($array_id['id_conta']);

            if($verificacao == 0)
            {

                Meta::analisaMeta2($array_id);

            }else{
                Meta::ativaProximaMeta($array_id['id_conta']);
            }

        }

    }


    public static function analisaMeta2($array_id)
    {

        $sql = new Sql();

        $resultado = $sql->select("SELECT meta.id_meta, meta.valor, conta.saldo FROM meta 
                                   INNER JOIN conta ON meta.id_conta = conta.id_conta 
                                   AND status = 'ativo' AND meta.id_conta = :ID_CONTA", array(
                                     ":ID_CONTA" => $array_id['id_conta']
                                   ));

        if($resultado[0]['saldo'] >= $resultado[0]['valor'])
        {

            $sql->execQuery("UPDATE meta SET status = 'concluido' WHERE id_meta = :ID_META", array(
                ":ID_META" => $resultado[0]['id_meta']
            ));

            Meta::ativaProximaMeta($array_id['id_conta']);

        }

    }


    public static function ativaProximaMeta($id_conta)
    {

        $sql = new Sql();

        $sql->execQuery("UPDATE meta SET status = 'ativo' 
                         WHERE status = 'pausado' AND data_inicial = (SELECT data_inicial FROM meta 
                            WHERE status = 'pausado' AND id_conta = :ID_CONTA ORDER BY data_inicial ASC limit 1) AND id_conta = :ID_CONTA", array(
                                ":ID_CONTA" => $id_conta
                            ));

    }


    public static function verificaMetaAtiva($id_conta)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT id_meta FROM meta WHERE status = 'ativo' AND id_conta = :ID_CONTA", array(
            ":ID_CONTA" => $id_conta
        ));

        if(count($results) > 0){

            return 0;

        } else{

            return 1;

        }

    }


    //===========================================
    public static function listaMetas($id_usuario)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT nome FROM meta WHERE id_usuario = :ID_USUARIO AND status = 1", array(
            ":ID_USUARIO" => $id_usuario
        ));

        return $results;
    }



}
?>