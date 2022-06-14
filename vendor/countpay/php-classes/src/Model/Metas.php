<?php 
namespace Countpay\Model;

use \Countpay\Model;
use \Countpay\DB\Sql;


class Metas extends Model{	

    /*===========================================================|===========================================================\\
	||											    																		 ||
	||										        FUNÇÕES GUARDANDO UMA GRANA                                              ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//============================================= CRIA - GUARDANDO UMA GRANA ==============================================//
    public static function criaGuardando($dados_meta, $id_usuario, $id_conta)
    {

        $sql = new Sql();

        $sql->execQuery("INSERT INTO meta (nome, objetivo, valor, data_inicial, data_final, status, id_conta, id_usuario) 
                         VALUES (:NOME, :OBJETIVO, :VALOR, :DATA_INICIAL, :DATA_FINAL, :STATUS, :ID_CONTA, :ID_USUARIO)", array(
                            ":NOME"=>$dados_meta['nome'],
                            ":OBJETIVO"=>$dados_meta['objetivo'],
                            ":VALOR"=>$dados_meta['valor'],
                            ":DATA_INICIAL"=>$dados_meta['data_inicial'],
                            ":DATA_FINAL"=>$dados_meta['data_final'],
                            ":STATUS"=> 1,
                            ":ID_CONTA"=>$id_conta,
                            ":ID_USUARIO"=>$id_usuario
                         ));

    }







}
?>