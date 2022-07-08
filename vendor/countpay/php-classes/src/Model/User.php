<?php 
namespace Countpay\Model;

use \Countpay\DB\Sql;

class User {

	Const SESSION = "User";

	#                                                  ╔═══════════════════════╗
	#									 	           ║  FUNÇÕES DE CADASTRO  ║
	#                                                  ╚═══════════════════════╝

	//Busca email e login do cadastro no banco para evitar cadastro duplo;
	public static function verificaDadosCadastro($dados_usuario)
	{

		$sql = new Sql();
		
		$results = $sql->select("SELECT * FROM usuario WHERE email = :EMAIL OR login = :LOGIN", array(
									':EMAIL'=>$dados_usuario['email'],
									':LOGIN'=>$dados_usuario['login']
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


	//Insere um novo usuário no banco com os dados cadastrados;
	public static function cadastraUsuario($dados_usuario)
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_usuario_inserir(:NOME, :SOBRENOME, :EMAIL, :DATA_NASCIMENTO, :LOGIN, :SENHA, :ID_TIPO_USUARIO)", array(
			':NOME'=>$dados_usuario['nome'],
			':SOBRENOME'=>$dados_usuario['sobrenome'],
			':EMAIL'=>$dados_usuario['email'],
			':DATA_NASCIMENTO'=>$dados_usuario['data_nascimento'],
			':LOGIN'=>$dados_usuario['login'],
			':SENHA'=>$dados_usuario['senha'],
			':ID_TIPO_USUARIO'=> 2
		));

		return $results[0];
		
	}


	#                                                  ╔════════════════════════╗
	#										    	   ║    FUNÇÕES DE LOGIN    ║
	#                                                  ╚════════════════════════╝

	//Login do administrador;
	public static function loginAdmin($login, $senha)
	{
		
		$resultado = User::verificaDadosLogin($login, $senha);

		// Se existe algo no array, atribua as variaveis com o resultado dos array na posição.
		if (!empty($resultado)) 
		{
			$id_usuario = $resultado[0]['id_usuario'];
			$resultado_login = $resultado[0]['login'];
			$resultado_senha = $resultado[0]['senha']; 
			$resultado_tipo_usuario = $resultado[0]['id_tipo_usuario'];

		} else {

			Visual::mostraMensagem('Login ou Senha invalido!', '/admin/login');
		}


		if ($resultado_login == $login && $resultado_senha == $senha && $resultado_tipo_usuario == 1) 
		{
			//Armazena id_usuario na session do admin;
			$_SESSION['admin'] = $id_usuario;
			header("Location: /admin");
			exit;

		} else {
			Visual::mostraMensagem('Login ou Senha incorreto!', '/admin/login');

		}

	}


	//Login de usuários normais;
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

			Visual::mostraMensagem('Usuário ou Senha incorreto!', '/login');
		}

	
		if ($resultado_login == $login && $resultado_senha == $senha && $tipo_usuario == 2) {
		
			//Armazena id_usuario na session do usuario;
			$_SESSION['usuario'] = $id_usuario;
			header("Location: /");
			exit;
	
		} else {
	
			Visual::mostraMensagem('Usuário ou Senha incorreto!', '/login');
	
		}

	}

	
	//Busca os dados do login no banco;
	public static function verificaDadosLogin($login, $senha)
	{

		$sql = new Sql();

		return $sql->select("SELECT id_usuario, login, senha, id_tipo_usuario FROM usuario WHERE login = :LOGIN AND senha = :SENHA", array(
						":LOGIN"=>$login,
						":SENHA"=>$senha
					));

	}

	#                                                  ╔════════════════════════╗
	#										    	   ║ FUNÇÕES DE VERIFICAÇÃO ║
	#                                                  ╚════════════════════════╝

	//Verifica se o usuário está logado & retorna o id_usuario;
	public static function verifyLogin()
	{

		if (!isset($_SESSION['usuario']))
		{
			header('Location: /login');
			exit;
		} 
		else 
		{
			return $_SESSION['usuario'];
		}

	}
	

	//Verifica se o admin está logado & retorna o id_usuario;
	public static function verifyLoginAdmin()
	{
		
		if (!isset($_SESSION['admin']))
		{
			header('Location: /admin/login');
			exit;
		}
		else
		{
			return $_SESSION['admin'];
		}

	}


	//Verifica se o cartão deletado pertence mesmo ao usuário;
	public static function verifyDeleteCartao($id_usuario, $id_cartao)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM cartao WHERE id_usuario = :ID_USUARIO AND id_cartao = :ID_CARTAO", array(
			"ID_USUARIO"=>$id_usuario,
			":ID_CARTAO"=>$id_cartao
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


	//Verifica se a conta deletada pertence mesmo ao usuário;
	public static function verifyDeleteConta($id_usuario, $id_conta)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM conta WHERE id_usuario = :ID_USUARIO AND id_conta = :ID_CONTA", array(
			"ID_USUARIO"=>$id_usuario,
			":ID_CONTA"=>$id_conta
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
	

	#                                                   ╔════════════════════════╗
	#					 					    	    ║  FUNÇÕES DO DASHBOARD  ║
	#                                                   ╚════════════════════════╝

	//Verifica se existe alguma notificação para o usuário ou para todos(NULL);
	public static function verificaNotificacoes($id_usuario)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT notificacoes.*, tipo_notificacoes.* 
								 FROM notificacoes
								 INNER JOIN tipo_notificacoes 
								 ON id_usuario = :ID_USUARIO OR id_usuario IS NULL", array(
			":ID_USUARIO" => $id_usuario
		));

		if(count($results) == 0)
		{
			$results[0]['id_notificacoes'] = "";
			$results[0]['titulo'] = "";
			$results[0]['descricao'] = "";
			$results[0]['id_tipo_notificacoes'] = "";
			$results[0]['data_emissao'] = "";
			$results[0]['id_usuario'] = "";
			$results[0]['categoria'] = "";
			$results[0]['visto'] = "";
			$results[0]['icone'] = "";

		}

		return $results;

	}


	#                                                   ╔═══════════════════════╗
	#					 					    	    ║   FUNÇÕES DO PERFIL   ║
	#                                                   ╚═══════════════════════╝

	//Busca os dados do perfil do usuário para o front;
	public static function carregaDadosPerfil($id_usuario)
	{

		$sql = new Sql();

		$results = $sql->select(
			"SELECT usuario.nome, usuario.sobrenome, usuario.email, usuario_perfil.* 
			FROM usuario_perfil 
			INNER JOIN usuario ON usuario.id_usuario = :ID_USUARIO AND usuario_perfil.id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));
		 
		
		if(count($results) > 0 )
		{
			return $results;
		}
		else
		{

			$dados_usuario = User::buscaPorId($id_usuario);

			$results[0]["nome"] = $dados_usuario['nome'];
			$results[0]["sobrenome"] = $dados_usuario['sobrenome'];
			$results[0]["email"] = $dados_usuario['email'];

			$results[0]["ocupacao"] = '';
			$results[0]["pais"] = '';
			$results[0]["cidade"] = '';
			$results[0]["endereco"] = '';
			$results[0]["telefone"] = '';
			$results[0]["sobre_mim"] = '';
			$results[0]["twitter"] = '';
			$results[0]["linkedin"] = '';
			$results[0]["facebook"] = '';
			$results[0]["instagram"] = '';
		}

		return $results;
		
	}


	//Busca todos os dados do usuário pelo seu id_usuario;
	public static function buscaPorId($id_usuario)
	{

		$sql = new Sql();
	
		$results = $sql->select("SELECT * FROM usuario WHERE id_usuario = :ID_USUARIO;", array(
									":ID_USUARIO"=>$id_usuario
								));
		

		if(isset($results[0]))
		{
			return $results[0];
		}

	}


	//Verifica se já existe dados cadastrados para fazer insert ou update;
	public static function verificaDadosPerfil($id_usuario)
	{

		$sql = new Sql();

		$result = $sql->select("SELECT usuario.nome, usuario.sobrenome, usuario.email, usuario_perfil.* 
								FROM usuario_perfil 
								INNER JOIN usuario ON usuario.id_usuario = :ID_USUARIO AND usuario_perfil.id_usuario = :ID_USUARIO", array(
									":ID_USUARIO"=>$id_usuario
								));
		
		if(count($result) > 0){
			return 1;
		}					
		else{
			return 0;
		}

	}


	//Faz update nos dados do perfil do usuário;
	public static function alteraDadosPerfil($id_usuario, $dado_perfil)
	{

		$sql = new Sql();

		$sql->execQuery("UPDATE usuario_perfil 
						SET ocupacao = :OCUPACAO, pais = :PAIS, cidade = :CIDADE, endereco = :ENDERECO, telefone = :TELEFONE, 
							sobre_mim = :SOBRE_MIM, twitter = :TWITTER, linkedin = :LINKEDIN, facebook = :FACEBOOK, instagram = :INSTAGRAM	
						WHERE id_usuario = :ID_USUARIO", array(
							":ID_USUARIO" => $id_usuario,
							":OCUPACAO" => $dado_perfil["ocupacao"],
							":PAIS" => $dado_perfil["pais"],
							":CIDADE" => $dado_perfil["cidade"],
							":ENDERECO" => $dado_perfil["endereco"],
							":TELEFONE" => $dado_perfil["telefone"],
							":SOBRE_MIM" => $dado_perfil["sobre_mim"],
							":TWITTER" => $dado_perfil["twitter"],
							":LINKEDIN" => $dado_perfil["linkedin"],
							":FACEBOOK" => $dado_perfil["facebook"],
							":INSTAGRAM" => $dado_perfil["instagram"],
						));

		$sql->execQuery("UPDATE usuario	
						 SET	nome = :NOME, sobrenome = :SOBRENOME, email = :EMAIL			
						 WHERE id_usuario = :ID_USUARIO", array(
							":ID_USUARIO" => $id_usuario,
							":NOME" => $dado_perfil["nome"],
							":SOBRENOME" => $dado_perfil["sobrenome"],
							":EMAIL" => $dado_perfil["email"]
						 ));

	}	


	//Faz o cadastro dos dados do perfil do usuário;
	public static function insereDadosPerfil($id_usuario, $dado_perfil)
	{

		$sql = new Sql();

		$sql->execQuery("INSERT INTO usuario_perfil (id_usuario, ocupacao, pais, cidade, endereco, telefone, sobre_mim, twitter, linkedin, facebook, instagram)
						 VALUES (:ID_USUARIO, :OCUPACAO, :PAIS, :CIDADE, :ENDERECO, :TELEFONE, :SOBRE_MIM, :TWITTER, :LINKEDIN, :FACEBOOK, :INSTAGRAM)",array(
							":ID_USUARIO" => $id_usuario,
							":OCUPACAO" => $dado_perfil["ocupacao"],
							":PAIS" => $dado_perfil["pais"],
							":CIDADE" => $dado_perfil["cidade"],
							":ENDERECO" => $dado_perfil["endereco"],
							":TELEFONE" => $dado_perfil["telefone"],
							":SOBRE_MIM" => $dado_perfil["sobre_mim"],
							":TWITTER" => $dado_perfil["twitter"],
							":LINKEDIN" => $dado_perfil["linkedin"],
							":FACEBOOK" => $dado_perfil["facebook"],
							":INSTAGRAM" => $dado_perfil["instagram"],
						 ));
		
		$sql->execQuery("UPDATE usuario	
						 SET	nome = :NOME, sobrenome = :SOBRENOME, email = :EMAIL			
						 WHERE id_usuario = :ID_USUARIO", array(
							":ID_USUARIO" => $id_usuario,
							":NOME" => $dado_perfil["nome"],
							":SOBRENOME" => $dado_perfil["sobrenome"],
							":EMAIL" => $dado_perfil["email"]
						));

	}


	#                                                  ╔══════════════════════════╗
	#										    	   ║  FUNÇÕES DO MUDAR_SENHA  ║
	#                                                  ╚══════════════════════════╝

	//Atualiza a senha do usuário, com confirmação;
	public static function atualizaSenha($id_usuario, $nova_senha, $senha_atual)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT senha FROM usuario WHERE id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));

		if($senha_atual == $results[0]['senha'])
		{
			$sql->execQuery("UPDATE usuario SET senha = :SENHA WHERE id_usuario = :ID_USUARIO", array(
				":ID_USUARIO"=>$id_usuario,
				":SENHA"=>$nova_senha
			));

			Visual::mostraMensagem('Senha alterada com sucesso!','/');
		}
		else
		{
			Visual::mostraMensagem('A senha atual está incorreta!','/mudar_senha');
		}

	}


	#                                                  ╔══════════════════════════╗
	#										    	   ║  FUNÇÕES DO ADM/USUARIO  ║
	#                                                  ╚══════════════════════════╝

	//Lista todos os usuários, arrumando a data de nascimento;
	public static function listaTodosUsuarios()
	{

		$sql = new Sql();

		$results = $sql->select("SELECT id_usuario, nome, sobrenome, email, data_nascimento, login FROM usuario ORDER BY id_usuario");

		foreach($results as $key => $value)
		{
			$data = date("d/m/Y", strtotime($results[$key]["data_nascimento"]));

			$results[$key]["data_nascimento"] = $data;
		}

		return $results;

	}


	#                                                  ╔════════════════════════════════╗
	#										    	   ║  FUNÇÕES DO ADM/USUARIO/CRIAR  ║
	#                                                  ╚════════════════════════════════╝
	
	//verificaAlteracao;
	//alteraUsuario;


	#                                                  ╔══════════════════════════════════╗
	#										    	   ║  FUNÇÕES DO ADM/USUARIO/ALTERAR  ║
	#                                                  ╚══════════════════════════════════╝

	//Verifica se os dados do usuário foram alterados no front para saber se o email ou login ja foram cadastrados;
	public static function verificaAlteracao($dados_usuario) /////erro
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuario WHERE id_usuario != :ID_USUARIO AND (email = :EMAIL OR login = :LOGIN)", array(
			':EMAIL'=>$dados_usuario['email'],
			':LOGIN'=>$dados_usuario['login'],
			':ID_USUARIO'=>$dados_usuario['id_usuario']
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


	//Faz o update dos dados do usuário com dados do front;
	public static function alteraUsuario($dados_usuario)
	{

		$sql = new Sql();

		$sql->execQuery("UPDATE usuario SET nome = :NOME, sobrenome = :SOBRENOME, email = :EMAIL, data_nascimento = :DATA_NASCIMENTO, login = :LOGIN WHERE id_usuario = :ID_USUARIO", array(
			':NOME'=>$dados_usuario['nome'],
			':SOBRENOME'=>$dados_usuario['sobrenome'],
			':EMAIL'=>$dados_usuario['email'],
			':DATA_NASCIMENTO'=>$dados_usuario['data_nascimento'],
			':LOGIN'=>$dados_usuario['login'],
			':ID_USUARIO'=>$dados_usuario['id_usuario']
		));

	}


	#                                                  ╔═════════════════════════════════╗
	#										    	   ║  FUNÇÕES DO ADM/USUARIO/DELETE  ║
	#                                                  ╚═════════════════════════════════╝

	//Deleta o usuário pelo seu id_usuario;
	public static function deletaUsuario($id_usuario)
	{

		$sql = new sql();

		$sql->execQuery("DELETE FROM usuario WHERE id_usuario = :ID_USUARIO", array(
			":ID_USUARIO"=>$id_usuario
		));

	}


	#                                                  ╔═════════════════════════════════════╗
	#										    	   ║  FUNÇÕES DO ADM/NOTIFICACOES/CRIAR  ║
	#                                                  ╚═════════════════════════════════════╝
		
	//Lista tipos de notificações para o front;
	public static function listaTipoNotificacao()
	{

		$sql = new Sql();

		return $sql->select("SELECT id_tipo_notificacoes, categoria FROM tipo_notificacoes");

	}


	//Cria notificação com dados do front;
	public static function criaNotificacao($dados_notificação, $id_usuario)
	{

		$sql = new Sql();

		$sql->execQuery("INSERT INTO notificacoes (titulo, descricao, id_tipo_notificacoes, id_usuario)
							VALUES (:TITULO, :DESCRICAO, :ID_TIPO_NOTIFICACOES, :ID_USUARIO)", array(
							":TITULO" => $dados_notificação['titulo'],
							":DESCRICAO" => $dados_notificação['descricao'],
							":ID_TIPO_NOTIFICACOES" => $dados_notificação['id_tipo_notificacoes'],
							"ID_USUARIO" => $id_usuario
							));

	}


	//Busca o id_usuario pelo email vindo do front e se n existir devolver erro;
	public static function BuscaEmail($dados_notificação)
	{

		if($dados_notificação['email'] != NULL)
		{
			$sql = new Sql();

			$results =  $sql->select("SELECT id_usuario FROM usuario WHERE email = :EMAIL", array(
										":EMAIL" => $dados_notificação['email']
									));
			
			if(count($results))
			{
				return $results[0]['id_usuario'];
			}
			else
			{
				Visual::mostraMensagem('Email não encontrado!', '/notificacoes/criar');
				exit;
			}
		}
		else
		{
			return NULL;
		}

	}


}
?>