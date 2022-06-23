<?php 
namespace Countpay\Model;

use \Countpay\DB\Sql;

class Projecoes {

	#                                                  ╔═══════════════════════╗
	#									 	           ║     	 GERAL         ║
	#                                                  ╚═══════════════════════╝

	
public static function janeiro($id_usuario){

	$sql = new Sql();

		$receita = $sql->select("SELECT SUM(valor) 'receita' FROM lancamento WHERE tipo_lancamento LIKE '%receita' AND id_usuario = :ID_USUARIO AND data_lancamento BETWEEN '2022-01-01' AND '2022-01-31'", array(
			":ID_USUARIO" => $id_usuario
		));

}

	
}


?>

