<?php 
namespace Countpay\Model;

use \Countpay\DB\Sql;
use \Countpay\Model;

class User extends Model	{

	Const SESSION = "User";

	protected $fields = [
		"id_usuario", "nome", "sobrenome", "email", "data_nascimento", "login", "senha", "id_tipo_usuario"
	];


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	   Funções de Verificação                                                ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//============================================  Função para verificar Login  ============================================//
	public static function verifyLogin()
	{
		if (!isset($_SESSION['usuario']))
		{
			header('Location: /admin/login');
			exit;
		}
	}

	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	    Funções de Mensagens                                                 ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//============================== Função para mandar uma mensagem para o usuario por pop-up ==============================//
	public static function mostraMensagem($mensagem, $rota)
	{
		echo "<script language='javascript' type='text/javascript'> alert('" .$mensagem. "');window.location.href='" . $rota . "';</script>";
	}


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	    Funções de Listagem                                                  ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//=========================================== Função listar todos os usuarios ===========================================//
	public static function listAll(){
		$sql = new sql();
			return $sql->select("SELECT * FROM  usuario");
	}


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	      Funções de Busca                                                   ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//===================================== Função para buscar usuario pelo id_usuario ======================================//
	public static function loadById($id_usuario)
	{
		$sql = new Sql();
	
		$results = $sql->select("SELECT id_usuario, nome, sobrenome, email, data_nascimento, login FROM usuario WHERE id_usuario = :ID_USUARIO;", array(
			":ID_USUARIO"=>$id_usuario
		));
		
		if(isset($results[0]))
		{
			return $results[0];
		}
	}


	//=============================== Função para buscar dados mostraveis de todos os usuarios ===============================//
	public static function loadAllUsers()
	{
		$sql = new Sql();

		$results = $sql->select("SELECT id_usuario, nome, sobrenome, email, data_nascimento, login FROM usuario ORDER BY id_usuario");

		return $results;
	}


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										            Funções de Alteração                                                 ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//===================================== Função para atualizar os dados do usuário =======================================//
	public function updateUserData() //update
	{
		$sql = new Sql();

		$results = $sql->select("CALL sp_usuario_update(:id_usuario, :nome, :sobrenome, :email, :data_nascimento, :login, :senha, :id_tipo_usuario)", array(
			
			":id_usuario"=>$this->getid_usuario(),
			":nome"=>$this->getnome(),
			":sobrenome"=>$this->getsobrenome(),
			":email"=>$this->getemail(),
			":login"=>$this->getlogin(),
			":senha"=>$this->getsenha(),
			":id_tipo_usuario"=>$this->getid_tipo_usuario()
		));
		$this->setData($results[0]);
	}


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										            Funções de Exclusão                                                  ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//================================== Função para deletar o usuario pelo id_usuario ======================================//
	public function deleteUser($id_usuario)	//delete
	{
		$sql = new sql();

		$sql->execQuery("DELETE FROM usuario WHERE id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));
	}

	
}
?>