<?php 
namespace Countpay\Model;

use \Countpay\DB\Sql;
use \Countpay\Model;

class User extends Model	{

	Const SESSION = "User";


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
			header('Location: /login');
			exit;
		} else {
			return $_SESSION['usuario'];
		}
	}


	//=======================================  Função para verificar Login do admin  ========================================//
	public static function verifyLoginAdmin()
	{
		if (!isset($_SESSION['admin']))
		{
			header('Location: /admin/login');
			exit;
		}
	}


	//==========================================  Função para pegar dados do login  ==========================================//
	public static function loginAdmin($login, $senha)
	{
		
		$resultado = User::verificaDadosLogin($login, $senha);

		// Se existe algo no array, atribua as variaveis com o resultado dos array na posição.
		if (!empty($resultado)) 
		{
			$resultado_login = $resultado[0]['login'];
			$resultado_senha = $resultado[0]['senha']; 
			$resultado_tipo_usuario = $resultado[0]['id_tipo_usuario'];

		} else {
			User::mostraMensagem('Login ou Senha invalido!', '/admin/login');
		}

		if ($resultado_login == $login && $resultado_senha == $senha && $resultado_tipo_usuario == 1) 
		{
			// ARMAZENA A SESSÃO SE O LOGIN SER EFETIVADO
			$_SESSION['admin'] = $resultado_login;
			header("Location: /admin");
			exit;

		} else {
			User::mostraMensagem('Usuário ou Senha incorreto!', '/admin/login');

		}
	}


	//
	public static function loginNormal($login, $senha)
	{

		$resultado = User::verificaDadosLogin($login, $senha);
	
		// Caso exista algo dentro do array, as variáveis recebe os valores da busca de forma separada e convertida para string
		if (!empty($resultado)) {
	
			$id_usuario = $resultado[0]['id_usuario'];
			$resultado_login = $resultado[0]['login'];
			$resultado_senha = $resultado[0]['senha']; 
			$tipo_usuario = $resultado[0]['id_tipo_usuario'];
		
		} else {
	
			User::mostraMensagem('Usuário ou Senha incorreto!', '/login');
	
		}
	
		if ($resultado_login == $login && $resultado_senha == $senha && $tipo_usuario == 2) {
		
			$_SESSION['usuario'] = $id_usuario;
			header("Location: /");
			exit;
	
		} else {
	
			User::mostraMensagem('Usuário ou Senha incorreto!', '/login');
	
		}

	}


	//======================================== Função para buscar dados para login ==========================================//
	public static function verificaDadosLogin($login, $senha)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT id_usuario, login, senha, id_tipo_usuario FROM usuario WHERE login = :LOGIN AND senha = :SENHA",
		array(
			":LOGIN"=>$login,
			":SENHA"=>$senha
		));

		return $results;
	}


	//==================================  Função para verificar se ja tem cadastro  ====================================//
	public static function verificaDadosCadastro($userData)
	{
		$sql = new Sql();
		
		$results = $sql->select("SELECT * FROM usuario WHERE email = :EMAIL OR login = :LOGIN", array(
				':EMAIL'=>$userData['email'],
				':LOGIN'=>$userData['login']
		));

		if(count($results) > 0)
		{
			return 0;
		} else {
			return 1;
		}
	}


	//=======================  Função para verificar se foi alterado o imput do cadastro  ==============================//
	public static function verificaAlteracao($userData)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuario WHERE id_usuario != :ID_USUARIO AND (email = :EMAIL OR login = :LOGIN) ", array(
			':EMAIL'=>$userData['email'],
			':LOGIN'=>$userData['login'],
			':ID_USUARIO'=>$userData['id_usuario']
		));

		if(count($results) > 0)
		{
			return 0;
		} else {
			return 1;
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
	public static function ListaTodosUsuarios()
	{
		$sql = new Sql();

		$results = $sql->select("SELECT id_usuario, nome, sobrenome, email, data_nascimento, login FROM usuario ORDER BY id_usuario");

		return $results;
	}


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										    	      Funções de Busca                                                   ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//===================================== Função para buscar usuario pelo id_usuario ======================================//
	public static function buscaPorId($id_usuario)
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


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										            Funções de Inserção                                                  ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//============================================ Função para criar novo usuario ===========================================//
	public static function cadastraUsuario($UserDados)
	{
		$sql = new Sql();

		// PASSANDO OS DADOS COLETADO PARA A STORED PROCEDURE E REALIZANDO A INSERÇÃO NO BANCO DE DADOS
		$results = $sql->select("CALL sp_usuario_inserir(:NOME, :SOBRENOME, :EMAIL, :DATA_NASCIMENTO, :LOGIN, :SENHA, :ID_TIPO_USUARIO)", array(
			':NOME'=>$UserDados['nome'],
			':SOBRENOME'=>$UserDados['sobrenome'],
			':EMAIL'=>$UserDados['email'],
			':DATA_NASCIMENTO'=>$UserDados['data_nascimento'],
			':LOGIN'=>$UserDados['login'],
			':SENHA'=>$UserDados['senha'],
			':ID_TIPO_USUARIO'=> 2
		));

		return $results;
	}



	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										            Funções de Alteração                                                 ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//===================================== Função para atualizar os dados do usuário =======================================//
	public static function alteraUsuario($UserDados)
	{
		$sql = new Sql();

		$sql->execQuery("UPDATE usuario SET nome = :NOME, sobrenome = :SOBRENOME, email = :EMAIL, data_nascimento = :DATA_NASCIMENTO, login = :LOGIN WHERE id_usuario = :ID_USUARIO", array(
			':NOME'=>$UserDados['nome'],
			':SOBRENOME'=>$UserDados['sobrenome'],
			':EMAIL'=>$UserDados['email'],
			':DATA_NASCIMENTO'=>$UserDados['data_nascimento'],
			':LOGIN'=>$UserDados['login'],
			':ID_USUARIO'=>$UserDados['id_usuario']
		));

		User::mostraMensagem('Usuário alterado com sucesso!','/admin/usuario');
		
	}


	/*===========================================================|===========================================================\\
	||											    																		 ||
	||										            Funções de Exclusão                                                  ||
	||												    																	 ||
	//===========================================================|===========================================================*/

	//================================== Função para deletar o usuario pelo id_usuario ======================================//
	public static function deletaUsuario($id_usuario)
	{
		$sql = new sql();

		$sql->execQuery("DELETE FROM usuario WHERE id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));
	}

	
}
?>